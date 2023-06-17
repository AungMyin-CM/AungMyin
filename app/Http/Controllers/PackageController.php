<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('package.index')->with('packages', $packages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('package.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
        ]);

        $number = $request->trialPeriodNumber;
        $unit = $request->trialPeriodUnit;

        // Convert the selected unit to days
        switch ($unit) {
            case 'weeks':
                $days = $number * 7;
                break;
            case 'months':
                $days = $number * 30;
                break;
            default:
                $days = $number;
        }

        $formFields = [
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'trialPeriod' => $days,
            'isDiscount' => $request->isDiscount,
            'discountPercentage' => $request->discountPercentage,
            'discountStartDate' => $request->discountStartDate,
            'discountEndDate' => $request->discountEndDate,
        ];

        Package::create($formFields);

        return redirect('aung_myin/admin_dashboard/package')->with('success', 'Package created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::findOrFail($id);

        $categories = ['days', 'weeks', 'months'];

        $days = $package->trialPeriod;
        if ($days >= 30 && $days % 30 === 0) {
            $number = $days / 30;
            $unit = 'months';
        } elseif ($days >= 7 && $days % 7 === 0) {
            $number = $days / 7;
            $unit = 'weeks';
        } else {
            $number = $days;
            $unit = 'days';
        }

        return view('package.edit')
            ->with('package', $package)
            ->with('categories', $categories)
            ->with('number', $number)
            ->with('unit', $unit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required'
        ]);

        $number = $request->trialPeriodNumber;
        $unit = $request->trialPeriodUnit;

        // Convert the selected unit to days
        switch ($unit) {
            case 'weeks':
                $days = $number * 7;
                break;
            case 'months':
                $days = $number * 30;
                break;
            default:
                $days = $number;
        }


        $formFields = [
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'trialPeriod' => $days,
            'isDiscount' => $request->isDiscount,
            'discountPercentage' => $request->discountPercentage,
            'discountStartDate' => $request->discountStartDate,
            'discountEndDate' => $request->discountEndDate,
        ];

        Package::where('id', $id)->update($formFields);

        return redirect('aung_myin/admin_dashboard/package')->with('success', 'Package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Package::where('id', $id)->delete();
        return redirect('aung_myin/admin_dashboard/package')->with('success', 'Package deleted successfully!');
    }
}
