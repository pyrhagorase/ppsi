<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis;
use App\Models\MyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Search service by tracking ID
     */
    public function searchTracking(Request $request)
    {
        $request->validate([
            'id_tracking' => 'required|string'
        ]);

        $servis = Servis::where('id_tracking', $request->id_tracking)->first();

        if (!$servis) {
            return response()->json([
                'success' => false,
                'message' => 'Service dengan ID Tracking tersebut tidak ditemukan'
            ]);
        }

        // Check if user already saved this service
        $isSaved = MyService::where('user_id', Auth::id())
                           ->where('id_tracking', $request->id_tracking)
                           ->exists();

        // Debug log untuk melihat data yang dikembalikan
        Log::info('Service data:', $servis->toArray());

        return response()->json([
            'success' => true,
            'data' => $servis,
            'is_saved' => $isSaved
        ]);
    }

    /**
     * Save service to My Services
     */
    public function saveToMyServices(Request $request)
    {
        $request->validate([
            'id_tracking' => 'required|string'
        ]);

        // Check if service exists
        $servis = Servis::where('id_tracking', $request->id_tracking)->first();
        if (!$servis) {
            return response()->json([
                'success' => false,
                'message' => 'Service tidak ditemukan'
            ]);
        }

        // Check if already saved
        $existingService = MyService::where('user_id', Auth::id())
                                  ->where('id_tracking', $request->id_tracking)
                                  ->first();

        if ($existingService) {
            return response()->json([
                'success' => false,
                'message' => 'Service sudah tersimpan di My Services'
            ]);
        }

        // Save to My Services
        MyService::create([
            'user_id' => Auth::id(),
            'id_tracking' => $request->id_tracking
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Service berhasil disimpan ke My Services'
        ]);
    }

    /**
     * Get user's saved services
     */
    public function getMyServices()
    {
        $myServices = MyService::with('servis')
                              ->where('user_id', Auth::id())
                              ->get();

        return response()->json([
            'success' => true,
            'data' => $myServices
        ]);
    }

    /**
     * Remove service from My Services
     */
    public function removeFromMyServices(Request $request)
    {
        $request->validate([
            'id_tracking' => 'required|string'
        ]);

        $myService = MyService::where('user_id', Auth::id())
                             ->where('id_tracking', $request->id_tracking)
                             ->first();

        if (!$myService) {
            return response()->json([
                'success' => false,
                'message' => 'Service tidak ditemukan di My Services'
            ]);
        }

        $myService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service berhasil dihapus dari My Services'
        ]);
    }

    /**
     * Get service detail
     */
    public function getServiceDetail($id_tracking)
    {
        $servis = Servis::where('id_tracking', $id_tracking)->first();

        if (!$servis) {
            return response()->json([
                'success' => false,
                'message' => 'Service tidak ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $servis
        ]);
    }

    public function confirmPayment(Request $request)
{
    $request->validate([
        'id_tracking' => 'required|string',
        'action' => 'required|in:confirm,reject'
    ]);

    $servis = Servis::where('id_tracking', $request->id_tracking)->first();
    
    if (!$servis) {
        return response()->json([
            'success' => false,
            'message' => 'Service tidak ditemukan'
        ]);
    }

    if ($request->action === 'confirm') {
        $servis->statusservis = 'Diproses';
        $servis->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Konfirmasi berhasil, service akan segera diproses'
        ]);
    } else {
        // Handle rejection logic
        return response()->json([
            'success' => true,
            'message' => 'Penolakan berhasil dikirim'
        ]);
    }
}
}