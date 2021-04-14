<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\AttributeRequest;
use App\Http\Requests\AttributeOptionRequest;

use App\Attribute;
use App\AttributeOption;

class AttributeController extends Controller
{
    public function __construct()
    {
        $this->data['types'] = Attribute::types();
        $this->data['booleanOptions'] = Attribute::booleanOptions();
        $this->data['validations'] = Attribute::validations();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['attributes'] = Attribute::orderBy('name', 'ASC')->paginate(10);
        return view('admin.attributes.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['attribute'] = null;

        return view('admin.attributes.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $params = $request->except('_token');
        // dd($params);
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_filterable'] = (bool) $params['is_filterable'];
        $params['is_configurable'] = (bool) $params['is_configurable'];

        if(Attribute::create($params)) {
            session()->flash('success', 'Attribute has been saved.');
        }

        return redirect()->route('attributes.index');
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
        $attribute = Attribute::findOrFail($id);
        $this->data['attribute'] = $attribute;
        return view('admin.attributes.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_filterable'] = (bool) $params['is_filterable'];
        $params['is_configurable'] = (bool) $params['is_configurable'];

        // unset agar tidak diupdate fieldnya
        unset($params['code']);
        unset($params['type']);

        $attribute = Attribute::findOrFail($id);
        if($attribute->update($params)) {
            session()->flash('success', 'Attribute has been updated.');
        }

        return redirect()->route('attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        if($attribute->delete()) {
            session()->flash('success', 'Attribute has been deleted.');
        }

        return redirect()->route('attributes.index');
    }

    public function options($attributeID)
    {
        // if(empty($AttributeID)) {
        //     return redirect()->route('attributes.index');
        // }

        $attribute = Attribute::findOrFail($attributeID);
        $this->data['attribute'] = $attribute;

        return view('admin.attributes.options', $this->data);
    }

    public function store_option(AttributeOptionRequest $request, $attributeID)
    {
        $params = [
            'attribute_id' => $attributeID,
            'name' => $request->get('name'),
        ];

        if(AttributeOption::create($params)) {
            session()->flash('success', 'Option has been saved.');
        }

        return redirect()->to('admin/attributes/'. $attributeID .'/options');
    }

    public function edit_option($optionID)
    {
        $attributeOption = AttributeOption::findOrFail($optionID);
        $this->data['attributeOption'] = $attributeOption;
        $this->data['attribute'] = $attributeOption->attribute;
        return view('admin.attributes.options', $this->data);
    }

    public function update_option(AttributeOptionRequest $request, $optionID)
    {
        $attributeOption = AttributeOption::findOrFail($optionID);
        $params = $request->except('_token');

        if($attributeOption->update($params)) {
            session()->flash('success', 'Option has been updated.');
        }

        return redirect()->to('admin/attributes/'. $attributeOption->attribute->id .'/options');
    }

    public function remove_option($optionID)
    {
        $attributeOption = AttributeOption::findOrFail($optionID);
        if($attributeOption->delete()) {
            session()->flash('success', 'Option has been deleted.');
        }

        return redirect()->to('admin/attributes/'. $attributeOption->attribute->id .'/options');
    }
}
