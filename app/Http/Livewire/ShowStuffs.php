<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\Stuff;
use Livewire\Component;
use Livewire\WithPagination;

class ShowStuffs extends Component
{
    use WithPagination;

    public $filter = [];

    protected $queryString = [
        'filter' => [],
        'page' => ['except' => 1],
    ];

    protected $paginationTheme = 'bootstrap';

    public $page = 1;

    protected $rows = 40;


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $filterData = [];
        foreach (Property::all() as $property) {
            $filterData[$property->name] = $property->values->map(function ($row) {
                return $row->value;
            })->unique();
        }

        $stuffs = new Stuff();
        if (!empty($this->filter) and is_array($this->filter)) {
            $filters = $this->filter;
            $stuffs = $stuffs->whereHas('properties', function ($q) use ($filters) {
                $i = 0;
                foreach ($filters as $name => $values) {
                    foreach ($values as $k => $v) {
                        if (empty($v)) {
                            unset($values[$k]);
                        }
                    }
                    if (empty($values)) {
                        continue;
                    }
                    $property = Property::where('name', $name)->first();
                    if (empty($property)) {
                        continue;
                    }
                    if (!$i) {
                        $q->where('property_id', $property->id)->whereIn('value', $values);
                    } else {
                        $q->orWhere('property_id', $property->id)->whereIn('value', $values);
                    }
                    $i++;
                }
            });

        }
        $stuffs = $stuffs->paginate($this->rows);
        return view('livewire.show-stuffs', ['stuffs' => $stuffs, 'filterData' => $filterData]);
    }
}
