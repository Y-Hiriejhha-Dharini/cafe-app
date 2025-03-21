<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Mail\ClientPasswordMail;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->has('search')) {
            $query->where('first_name', 'LIKE', "%{$request->search}%")
                ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                ->orWhere('email', 'LIKE', "%{$request->search}%")
                ->orWhere('contact', 'LIKE', "%{$request->search}%");

        }

        if (!is_null($request->sort_column) && !is_null($request->sort_direction)) {
            $sortColumn = $request->sort_column;
            $sortDirection = $request->sort_direction;

            if ($sortColumn == 'name') {
                $query->orderBy('first_name', $sortDirection)
                    ->orderBy('last_name', $sortDirection);
            } else {
                $query->orderBy($sortColumn, $sortDirection);
            }
        }

        $clients = $query->paginate($request->per_page ?? 10);
        if ($request->ajax()) {
            return response()->json(
                [
                    'clients' => $clients->items(),
                    'nextPage' => $clients->nextPageUrl(),
                ]);
        }

        return view('components.client.index', [
                'clients' => $clients,
                'nextPage' => $clients->nextPageUrl()
            ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateClientRequest $request)
    {
        $validatedData = $request->validated();

        $dob = $validatedData['dob_year'].'-'.
                str_pad($validatedData['dob_month'], 2, 0, STR_PAD_LEFT).'-'.
                str_pad($validatedData['dob_day'], 2, 0, STR_PAD_LEFT);

        $address = $validatedData['street_no'].', '.
                    $validatedData['street_address'].', '.
                    $validatedData['city'];

        unset($validatedData['dob_year'], $validatedData['dob_month'] , $validatedData['dob_day']);
        unset($validatedData['street_no'], $validatedData['street_address'], $validatedData['city']);

        $validatedData['dob'] = $dob;
        $validatedData['address'] = $address;

        $client = Client::create($validatedData);

        $password = str::random(10);

        /* mail configuration need to done in .env */
        // Mail::to($client->email)->send(new ClientPasswordMail($client->email, $password));

        return redirect()->route('client.index')
            ->with('success', 'Client created successfully. Password sent to email.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return  response()->json([
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('components.client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $validatedData = $request->validated();

        $updateData = $this->createDobAddress($validatedData);

        $client->update($updateData);

        return redirect()->route('client.index')->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(['message' => 'Client deleted successfully.']);
    }

    private function createDobAddress($validatedData)
    {
        $dob = $validatedData['dob_year'].'-'.
                str_pad($validatedData['dob_month'], 2, 0, STR_PAD_LEFT).'-'.
                str_pad($validatedData['dob_day'], 2, 0, STR_PAD_LEFT);

        $address = $validatedData['street_no'].', '.
                    $validatedData['street_address'].', '.
                    $validatedData['city'];

        unset($validatedData['dob_year'], $validatedData['dob_month'] , $validatedData['dob_day']);
        unset($validatedData['street_no'], $validatedData['street_address'], $validatedData['city']);

        $validatedData['dob'] = $dob;
        $validatedData['address'] = $address;

        return $validatedData;
    }
}
