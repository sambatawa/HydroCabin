<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Kreait\Firebase\Factory;      
use Kreait\Firebase\Exception\AuthException;
use Kreait\Firebase\Database;

class AuthController extends Controller
{
    protected $database;

    public function __construct()
    {
        $serviceAccount = base_path('storage/app/firebase/firebase_credentials.json');
        if (!file_exists($serviceAccount)) {
            throw new \Exception('Firebase credentials file not found at: ' . $serviceAccount);
        }
        $factory = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));
        $this->database = $factory->createDatabase();
    }

    public function loginForm()
    {
        if (Session::has('user')) {
            Session::forget('user');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            $users = $this->database->getReference('Users')->getValue();
            $user = null;
            $userId = null;

            foreach ($users as $id => $userData) {
                if ($userData['email'] === $credentials['email']) {
                    $user = $userData;
                    $userId = $id;
                    break;
                }
            }

            if (!$user || !Hash::check($credentials['password'], $user['password'])) {
                return back()->withErrors([
                    'email' => 'Email atau password salah.'
                ])->withInput();
            }
            Session::put('user', [
                'uid' => $userId,
                'email' => $user['email'],
                'name' => $user['name'],
                'role' => $user['role']
            ]);
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Terjadi kesalahan saat login.'
            ])->withInput();
        }
    }
    
    public function firebaseSignIn(Request $request)
    {
        $idToken = $request->input('idToken');
        try {
            $verifiedToken = $this->verifyFirebaseToken($idToken);
            $uid = $verifiedToken->claims()->get('sub');
            $email = $verifiedToken->claims()->get('email');
            $users = $this->database->getReference('Users')->getValue();
            $user = null;
            $userId = null;
            foreach ($users as $id => $userData) {
                if ($userData['email'] === $email) {
                    $user = $userData;
                    $userId = $id;
                    break;
                }
            }

            if (!$user) {
                $newUserRef = $this->database->getReference('Users')->push();
                $userId = $newUserRef->getKey();
                $user = [
                    'email' => $email,
                    'name' => $verifiedToken->claims()->get('name') ?? explode('@', $email)[0],
                    'role' => 'user',
                    'hasAccess' => true,
                    'created_at' => now()->toDateTimeString()
                ];
                $newUserRef->set($user);
            }

            if (isset($user['hasAccess']) && !$user['hasAccess']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akses login Anda telah diblokir. Silakan hubungi administrator.'
                ], 403);
            }
            Session::put('user', [
                'uid' => $userId,
                'email' => $email,
                'name' => $user['name'],
                'role' => $user['role']
            ]);
            return response()->json([
                'success' => true,
                'redirect' => route('dashboard')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal verifikasi token'
            ], 401);
        }
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,admin',
        ]);

        $users = $this->database->getReference('Users')->getValue();
        if ($users) {
            foreach ($users as $user) {
                if ($user['email'] === $request->email) {
                    return back()->withErrors([
                        'email' => 'Email sudah terdaftar.'
                    ])->withInput();
                }
            }
        }
        $reference = $this->database->getReference('Users');
        $reference->push([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'hasAccess' => true,
            'created_at' => now()->toDateTimeString(),
        ]);
        Session::forget('user');
        return redirect()->route('login.form')
            ->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }

    public function index()
    {
        if (!Session::has('user')) {
            return redirect()->route('login.form');
        }
        $userId = Session::get('user')['uid'];
        $sensorData = $this->database->getReference("SensorData/{$userId}")->getValue();
        return view('dashboard', [
            'user' => Session::get('user'),
            'sensorData' => $sensorData
        ]);
    }

    public function alertHistory()
    {
        if (!Session::has('user')) {
            return redirect()->route('login.form');
        }
        $userId = Session::get('user')['uid'];
        $alertHistory = $this->database->getReference("SensorData/{$userId}/alertHistory")->getValue();
        return view('alert-history', [
            'user' => Session::get('user'),
            'alertHistory' => $alertHistory
        ]);
    }
    public function logout(Request $request)
    {
        Session::forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('welcome');
    }

    private function verifyFirebaseToken($idToken)
    {
        return app('firebase.auth')->verifyIdToken($idToken);
    }
}