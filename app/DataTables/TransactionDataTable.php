<?php

namespace App\DataTables;

use App\Helpers\AdminHelper;

use App\Models\Admin;
use App\Models\Transaction;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Str;

class TransactionDataTable extends DataTable
{

    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'admin.admins.transaction_datatables_actions')
            ->addIndexColumn()
            ->addColumn('Sl', '')
            ->addColumn('', '')
            ->addColumn('user',function($dataTable){
                return $dataTable->user->name;
            })
            ->addColumn('date',function($dataTable){
                return $dataTable->created_at->toFormattedDateString();
            })
            // ->addColumn('image', function ($dataTable) {
            //     return "<img src='".asset('images/'.$dataTable->image)."'/>";
            // })
            // ->addColumn('file',function($dataTable){
            //     return "<a download href='".asset('files/'. $dataTable->file)."'>Download</a>";
            // })
            ->rawColumns(['action', 'image', 'file']);
    }

    public function query(Transaction $model)
    {
        return $model->newQuery()->with('user');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false,'title'=>__('Action')])
            ->parameters(AdminHelper::datatableDesign("User","admin-delete","admin.admins.deleteBySelection"));
    }

    protected function getColumns()
    {
        return [
            '',
            'id',
            ['data'=>'Sl','title'=>__('Sl')],
            ['data'=>'user','title'=>__('User')],
            ['data'=>'amount','title'=>__('Amount')],
            ['data'=>'date','title'=>__('Date')],
        ];
    }

    protected function filename()
    {
        return 'admins_datatable_' . time();
    }
}
