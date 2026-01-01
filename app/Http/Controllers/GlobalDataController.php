<?php

namespace App\Http\Controllers;

use App\Models\GlobalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GlobalDataController extends Controller
{
    //
    public function getGlobalData(){
        $globals=GlobalData::first();
        return view("admin.globals-admin",["globals"=>$globals]);
    }
    public function updateGlobalData(Request $req){
        $oldData=GlobalData::first();
        // remove empty inputs then implode
        $numbers = collect($validated['contact_numbers'] ?? [])
            ->filter(fn ($n) => trim($n) !== '')
            ->implode(',');

            // 
        $newData=$req->validate([
            "website_name"=>"string|required",
            "website_logo"=>"image|nullable",
            "contact_numbers"=>"string",
            "contact_email"=>"string|nullable",
            "address"=>"string|nullable",
            "about_us"=>"string|nullable",
        ]);
        if($req->hasFile('website_logo')){
            if(Storage::disk('public')->exists($oldData->website_logo)){
                Storage::disk('public')->delete($oldData->website_logo);
            }
            // new one
            $newPath=$req->file('website_logo')->store('logo','public');
            $newData['website_logo']="/".$newPath;
        }
        $newData['contact_numbers']=$numbers;
        $oldData->update($newData);
        return redirect()->back()->with("success","Global data updated successfully.");
    }
}
