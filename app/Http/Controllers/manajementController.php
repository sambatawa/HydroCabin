<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class manajementController extends Controller
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

    public function index()
    {
        $settings = $this->database->getReference('SensorSettings')->getValue();
        return view('manajemen', [
            'settings' => $settings,
            'user' => Session::get('user')
        ]);
    }

    public function updateSensorSettings(Request $request)
    {
        $request->validate([
            'min_ph' => 'required|numeric',
            'max_ph' => 'required|numeric',
            'min_tds' => 'required|numeric',
            'max_tds' => 'required|numeric',
            'min_temp' => 'required|numeric',
            'max_temp' => 'required|numeric',
            'min_humidity' => 'required|numeric',
            'max_humidity' => 'required|numeric'
        ]);

        try {
            $reference = $this->database->getReference('SensorSettings');
            $reference->update([
                'ph' => [
                    'min' => $request->min_ph,
                    'max' => $request->max_ph
                ],
                'tds' => [
                    'min' => $request->min_tds,
                    'max' => $request->max_tds
                ],
                'temperature' => [
                    'min' => $request->min_temp,
                    'max' => $request->max_temp
                ],
                'humidity' => [
                    'min' => $request->min_humidity,
                    'max' => $request->max_humidity
                ],
                'updated_at' => now()->toDateTimeString()
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Pengaturan sensor berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate pengaturan sensor: ' . $e->getMessage()
            ], 500);
        }
    }

    public function userManagement()
    {
        $users = $this->database->getReference('Users')->getValue();
        return view('manajemen.user', [
            'users' => $users,
            'user' => Session::get('user')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,admin'
        ]);
        try {
            $users = $this->database->getReference('Users')->getValue();
            if ($users) {
                foreach ($users as $user) {
                    if ($user['email'] === $request->email) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Email sudah terdaftar.'
                        ], 422);
                    }
                }
            }
            $reference = $this->database->getReference('Users');
            $reference->push([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'created_at' => now()->toDateTimeString()
            ]);
            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:user,admin'
        ]);
        try {
            $reference = $this->database->getReference('Users/' . $id);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'updated_at' => now()->toDateTimeString()
            ];
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
            $reference->update($data);
            return response()->json([
                'success' => true,
                'message' => 'User berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->database->getReference('Users/' . $id)->remove();
            return redirect()->route('user')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('user')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }

    public function toggleAccess($id)
    {
        try {
            $reference = $this->database->getReference('Users/' . $id);
            $user = $reference->getValue();
            $reference->update([
                'hasAccess' => !$user['hasAccess'],
                'updated_at' => now()->toDateTimeString()
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Status akses login user berhasil diubah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status akses login: ' . $e->getMessage()
            ], 500);
        }
    }
}