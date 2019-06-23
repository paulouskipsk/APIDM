<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class Revenue extends Model
{
    protected $fillable = [
        'id',
        'description',
        'status',
        'receivingValue',
        'receivingDate',
        'received',
        'comments',
        'category',
    ];
    public function __construct(
        $id = null,
        $description = null,
        $status = null,
        $receivingValue = null,
        $receivingDate = null,
        $received = null,
        $comments = null,
        $category = null,
        $paidByUser = null
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->status = $status;
        $this->receivingValue = $receivingValue;
        $this->receivingDate = $receivingDate;
        $this->received = $received;
        $this->comments = $comments;
        $this->category = $category;
    }

    public static function getAll()
    {
        $data = DB::table('revenues')
            ->orderBy('description')
            ->where('status', '<>', 'D')
            ->get();
        $revenues = array();
        foreach ($data as $item) {
            $revenue = new Revenue(
                $item->id,
                $item->description,
                $item->status,
                $item->receivingValue,
                $item->receivingDate,
                $item->received,
                $item->comments,
                Category::findById($item->category_id)
            );

            array_push($revenues, $revenue);
        }
        return $revenues;
    }

    public static function findById($id)
    {
        $item = DB::table('revenues')
                    ->where('revenues.id', $id)
                    ->first();
                    
        if(isset($item)){
            return new Revenue(
                $item->id,
                $item->description,
                $item->status,
                $item->receivingValue,
                $item->receivingDate,
                $item->received,
                $item->comments,
                Category::findById($item->category_id)
            );
        }         
        return new Revenue();
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            DB::table('revenues')->insert([
                'description' => $this->description,
                'status' => $this->status,
                'receivingValue' => $this->receivingValue,
                'receivingDate' => $this->receivingDate,
                'received' => $this->received,
                'comments' => $this->comments,
                'category_id' => $this->category->id,
            ]);
            DB::commit();
            return true;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao salvar a Receita : "+$err));
        }
    }

    public function _update()
    {
        try {
            DB::beginTransaction();
            DB::table('revenues')
                ->where('id', $this->id)
                ->update([
                    'description' => $this->description,
                    'status' => $this->status,
                    'receivingValue' => $this->receivingValue,
                    'receivingDate' => $this->receivingDate,
                    'received' => $this->received,
                    'comments' => $this->comments,
                    'category_id' => $this->category->id,
                ]);
            DB::commit();
            return true;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao Atualizar a Receita : "+$err));
        }
    }

    public function drop($id)
    {
        try {
            DB::beginTransaction();
            DB::table('revenues')
                ->where('id', $this->id)
                ->update(['status' => 'D']);
            DB::commit();
            return true;
        } catch (Exception $err) {
            DB::rollback();
            return throwException(new Exception("Erro ao Deletar a Receita : "+$err));
        }
    }
}
