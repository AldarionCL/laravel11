<?php

namespace App\Http\Livewire\Accessory;

use App\Models\CallCenterTicket\CallCenterTicket;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;

class ReportAccessory extends Component
{


    public function render()
    {
        $agents = CallCenterTicket::select('id', 'assigned')->with('responsible:ID,Nombre')->get();

        $columnChartModel = $agents->groupBy('assigned')
            ->reduce(function ($column, $data) {
                //dd();
                $type = $data->first()->responsible->Nombre;
                $value = $data->count('assigned');

                $color = randomColor();

                return $column->addColumn($type, $value, $color );

            }, LivewireCharts::columnChartModel()
                ->setTitle('Tickets x Agentes')
                //->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                // ->setDataLabelsEnabled($this->showDataLabels)
                //->setOpacity(0.25)
                // ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                ->setColumnWidth(20)
                ->withGrid()
            );

        $pieChartModel = $agents->groupBy('assigned')
            ->reduce(function ($column, $data) {
                $type = $data->first()->responsible->Nombre;
                $value = $data->count('assigned');

                $color = randomColor();

                return $column->addSlice($type, $value, $color );

            }, LivewireCharts::pieChartModel()
                ->setTitle('Tickets x Agentes')
                //->setAnimated($this->firstRun)
                //->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                // ->setDataLabelsEnabled($this->showDataLabels)
                //->setOpacity(0.25)
                //->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                //->setColumnWidth(90)
                ->withGrid()
            );

        return view('livewire.call-center.report-call-center', [
            'columnChartModel' => $columnChartModel,
            'pieChartModel' => $pieChartModel
        ]);
    }
}
