
<div class="card card">
    <div class="card-header">
        <span class="fa fa-list"></span> Visitas
    </div>
    <div class="table-responsive p-3">

        <livewire:reception.datatables.visitas-datatable :params="1"/>

    </div>
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            font-size: 12px;
        }
    </style>

</div>


