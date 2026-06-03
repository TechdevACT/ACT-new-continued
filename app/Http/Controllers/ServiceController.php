<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'services' => 'required|array',
        ]);

        // Get all existing service ids to determine which ones to delete if they are removed
        $existingServiceIds = Service::pluck('id')->toArray();
        $submittedServiceIds = [];

        foreach ($request->services as $serviceData) {
            $service = null;
            if (isset($serviceData['id'])) {
                $service = Service::find($serviceData['id']);
                if ($service) {
                    $submittedServiceIds[] = $service->id;
                }
            }

            if (!$service) {
                $service = new Service();
            }

            $service->name = $serviceData['name'] ?? '';
            $service->description = $serviceData['description'] ?? '';
            $service->url = $serviceData['url'] ?? '';

            if (isset($serviceData['image']) && $serviceData['image'] instanceof \Illuminate\Http\UploadedFile) {
                // Delete old image if exists
                if ($service->image) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $service->image));
                }
                
                $path = $serviceData['image']->store('images/services', 'public');
                $service->image = '/storage/' . $path;
            }

            $service->save();
        }

        // Delete services that were removed from the form
        $servicesToDelete = array_diff($existingServiceIds, $submittedServiceIds);
        if (!empty($servicesToDelete)) {
            $servicesToDel = Service::whereIn('id', $servicesToDelete)->get();
            foreach ($servicesToDel as $s) {
                if ($s->image) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $s->image));
                }
                $s->delete();
            }
        }

        return redirect()->back();
    }
}
