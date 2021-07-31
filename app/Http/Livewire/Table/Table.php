<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $model;
    public $name;
    public $search = '';

    public function get_pagination_data() {
        switch ($this->name){

            case 'user':
                $users = $this->model::where('email', 'LIKE', '%'. $this->search .'%')
                                ->orWhere('name', 'LIKE', '%'. $this->search .'%')
                                ->paginate(10);
            
                return [
                    'view' => 'livewire.table.user',
                    'users' => $users,
                ];
            break;

            case 'department':
                $departments = $this->model::where('descripcion', 'LIKE', '%'. $this->search .'%')
                                    ->orWhere('codigoUbigeo', 'LIKE', '%'. $this->search .'%')
                                    ->paginate(10);
            
                return [
                    'view' => 'livewire.table.department',
                    'departments' => $departments,
                ];
            break;

            case 'province':
                $provinces = $this->model::where('descripcion', 'LIKE', '%'. $this->search .'%')
                                ->orWhere('codigoUbigeo', 'LIKE', '%'. $this->search .'%')
                                ->paginate(10);
            
                return [
                    'view' => 'livewire.table.province',
                    'provinces' => $provinces,
                ];
            break;

            case 'district':
                $districts = $this->model::where('descripcion', 'LIKE', '%'. $this->search .'%')
                                ->orWhere('codigoUbigeo', 'LIKE', '%'. $this->search .'%')
                                ->paginate(10);
            
                return [
                    'view' => 'livewire.table.district',
                    'districts' => $districts,
                ];
            break;

            case 'populationCenter':
                $populationCenters = $this->model::where('codigoCentroPobladoMINEDU', 'LIKE', '%'. $this->search .'%')
                                        ->orWhere('cpinei', 'LIKE', '%'. $this->search .'%')
                                        ->orWhere('descripcion', 'LIKE', '%'. $this->search .'%')
                                        ->paginate(10);
            
                return [
                    'view' => 'livewire.table.populationCenter',
                    'populationCenters' => $populationCenters,
                ];
            break;

            case 'college':
                $colleges = $this->model::where('nombreCentroEducativo', 'LIKE', '%'. $this->search .'%')
                                ->orWhere('codigoLocal', 'LIKE', '%'. $this->search .'%')
                                ->orWhere('codigoModular', 'LIKE', '%'. $this->search .'%')
                                ->paginate(10);
            
                return [
                    'view' => 'livewire.table.college',
                    'colleges' => $colleges,
                ];
            break;

            default:
                # code...
            break;

        }
    }

    public function cleanPage(){
        $this->reset('page');
    }

    public function render(){  
        $data = $this->get_pagination_data();
        return view($data['view'], $data);
    }
}
