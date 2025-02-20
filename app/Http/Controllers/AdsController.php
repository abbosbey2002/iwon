<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ads\StoreAdsRequest;
use App\Http\Requests\Ads\UpdateAdsRequest;
use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ads = Ads::query()->latest()->paginate(20);

        return view('admin.ads.ads', compact('ads'));
    }

    public function status($status, Ads $ad, Request $request)
    {
        if ($status == 'stop') {
            $ad->status = 0;
            $ad->save();

            // $request->session()->flash('info', trans('admin.messages.stop'));
        } elseif ($status == 'active') {
            $ads = Ads::where('status', true)->first();
            if (! empty($ads)) {
                $ads->status = 0;
                $ads->save();
            }

            $ad->status = 1;
            $ad->save();

            // $request->session()->flash('info', trans('admin.messages.actived'));
        }

        return redirect()->back();
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(StoreAdsRequest $request)
    {
        if ($request->video) {
            $video = $request->file('video')->store('uploads/video');
        } else {
            $video = null;
        }

        if ($request->mobile) {
            $mobile = $request->file('mobile')->store('uploads/backgrounds/mobile');
        }

        if ($request->desktop) {
            $desktop = $request->file('desktop')->store('uploads/backgrounds/desktop');
        }

        $ads = Ads::create([
            'name' => $request->name,
            'video' => $video,
            'mobile' => $mobile,
            'desktop' => $desktop,
            'status' => 0,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
        ]);

        return redirect()->route('ads.index');
    }

    public function edit(Ads $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(UpdateAdsRequest $request, Ads $ad)
    {
        if ($request->video) {
            $video = $request->file('video')->store('uploads/video');
        } else {
            $video = $ad->video;
        }

        if ($request->mobile) {
            $mobile = $request->file('mobile')->store('uploads/backgrounds/mobile');
        } else {
            $mobile = $ad->mobile;
        }

        if ($request->desktop) {
            $desktop = $request->file('desktop')->store('uploads/backgrounds/desktop');
        } else {
            $desktop = $ad->desktop;
        }

        $ad->update([
            'name' => $request->name,
            'video' => $video,
            'mobile' => $mobile,
            'desktop' => $desktop,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
        ]);

        return redirect()->route('ads.index');
    }

    public function view()
    {
        $ads = Ads::query()->where('status', 1)->first();

        return view('pages.ads', compact('ads'));
    }

    public function destroy($id)
    {
        $ads = Ads::find($id);

        if ($ads->status === 1) {
            return redirect()
                ->route('ads.index')
                ->with('error', 'Active advertisements cannot be deleted.');
        }

        // Store file paths before deletion for cleanup
        $filesToDelete = array_filter([
            $ads->video ? storage_path('app/'.$ads->video) : null,
            $ads->mobile ? storage_path('app/'.$ads->mobile) : null,
            $ads->desktop ? storage_path('app/'.$ads->desktop) : null,
        ]);

        // Delete the database record
        $ads->delete();

        // Clean up associated files
        foreach ($filesToDelete as $filePath) {
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        return redirect()
            ->route('ads.index')
            ->with('success', 'Advertisement deleted successfully.');
    }

    public function show(Ads $ad)
    {
        return view('admin.ads.show', compact('ad'));
    }
}
