<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::orderBy('created_at','DESC')->paginate(10);
        return view('customers.index',compact('customers'));
    }    
    public function create(){
        return view('customers.add');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|max:13',
            'address' => 'required|string',
            //unique email tidak boleh ada yang sama
            'email' => 'required|email|string|unique:customers,email' //format yang diterima harus email
        ]);

        try{
            $customer = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email
            ]);
            return redirect('/customer')->with(['success' => ' Data telah disimpan']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id){
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }
    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|max:13',
            'address' => 'required|string',
            //unique email tidak boleh ada yang sama
            'email' => 'required|email|string|exists:customers,email' //format yang diterima harus email
        ]);

        try{
            $customer = Customer::find($id);
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,            
            ]);
        
            return redirect('/customer')->with(['success' => $customer->name . ' Data Telah Diupdate']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->get_message()]) ;
        }
        
    }
    public function destroy($id){
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with(['success' => $customer->name . ' Data Telah dihapus']);
    }
}