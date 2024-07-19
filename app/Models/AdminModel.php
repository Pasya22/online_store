<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    use HasFactory;
    public static function GetData($table)
    {
        return DB::table($table)->get();
    }
    public static function CreateData($table, $data)
    {
        return DB::table($table)->insert($data);
    }
    public static function updateData($table, $key, $value, $data)
    {
        return DB::table($table)->where($key, $value)->update($data);
    }
    public static function GetDataById($table, $key, $value)
    {
        return DB::table($table)->where($key, $value)->first();
    }
    public static function GetDataByIdd($table, $key, $value)
    {
        return DB::table($table)->where($key, $value)->get();
    }
    public static function GetDataByColumnExceptId($table, $column, $value, $id, $id2)
    {
        return DB::table($table)->where($column, $value)->where($id2, '!=', $id)->get();
    }
    public static function getNamaBarangById($table, $data, $id, $columnName)
    {
        return DB::table($table)->where($data, $id)->value($columnName);
    }
    public static function GetDataByColumn($table, $column, $value)
    {
        return DB::table($table)->where($column, $value)->first();
    }
    public static function DeleteById($table, $column, $value)
    {
        return DB::table($table)->where($column, $value)->delete();
    }
    public static function joinData()
    {
        // Menjalankan query dan mengambil data
        $data = DB::table('data_pembayaran')
            ->join('data_barang', 'data_barang.id_barang', '=', 'data_pembayaran.id_barang')
            ->join('user', 'user.id_user', '=', 'data_pembayaran.id_user')
            ->get();

        return $data; // Mengembalikan hasil query
    }
    public static function joinDataDiskon()
    {
        // Menjalankan query dan mengambil data
        return DB::table('diskon')
            ->select('data_barang.*', 'diskon.*')
            ->join('data_barang', 'data_barang.id_barang', '=', 'diskon.id_barang')
            ->get();
    }
    public static function joinDataDiskonById($id)
    {
        // Menjalankan query dan mengambil data
        return DB::table('data_barang')
            ->select('data_barang.*', 'diskon.*')
            ->join('diskon', 'diskon.id_barang', '=', 'data_barang.id_barang')
            ->where('data_barang.id_barang', $id)
            ->first();
    }
}
