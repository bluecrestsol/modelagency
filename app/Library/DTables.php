<?php

namespace App\Library;


use Illuminate\Http\Response;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\UserTowns;


/**
 * Usage:
 * DataTable::make( $columns, $eloquent, $searchQuery, $totalDisplayOfRecords )
 *
 * @param $columns array
 * * Every element of this array is the column of the data table and you can print the data from the eloquent using "{{database_column_here}}"
 * * So for example, you are going to print the user's nickname on a column.. you simply do "Hi! My name is {{nickname}} and I am a {{gender}}"
 * * "nickname" and "gender" is on the same column as what is specified on $eloquent variable
 * * You can also pass view, just simply pass "@view:<view_name_here>". And on your views, it will already contain the variable $data which is
 * * The eloquent object.
 *
 * @param $eloquent string
 * * The name of the eloquent model, so for example you are going to use the Videos model, you have to pass 'Video'.
 *
 *
 * $search 
 * $iTotalDisplayRecords 
 * $where = null 
 * $orderBy = null
 * $orderByFieldName = null
 * $data[ 'iDisplayLength', 'iDisplayStart', 'sEcho', 'whereField', 'whereData', 'serach' ]
 *
 *
 */

/* 
	$data[ 
		'where' => [ 'FIELD_NAME' => ['type','value'] ], 
		'columnSearch' => ['FIELD_NAME'], 
		'customSearch' => [ 'TYPE eg.(LIKE or < or >)', 'FIELD_NAME' ],
		'order' => [ 'orderBy' => 'ASC/DESC', 'orderByFieldName' => 'FIELD_NAME' ],
		'with' => [ 'relationship1', 'realtionship2' ],
		'whereHas' =>  [ 'eloquent_relations' => [ 'field_name', 'operator', 'value' ] ],
		'withSearch'	=> [ 'relationship1' => ['type', 'fieldname'] ]
	]
	
	ex.
	$data[	
		'where' => [ 'title' => ['like', $request->get('title') ], 'status' => ['=', (($request->has('status')) ? $request->get('status') : 3) ] ], 
        'columnSearch' => [], 
        'customSearch' => [],
        'order' => [ 'sortBy' => 'desc', 'orderByFieldName' => 'updated_at' ],
        'with' => ['user'], // 'relationship1', 'realtionship2'
        'whereHas' => [ 'user' => [ 'username', '=', $request->get('user') ] ], //orwhereHas [ 'eloquent_relations' => [ 'field_name', 'operator', 'value' ] ]
        'withSearch' => []//'relationship1' => ['type', 'fieldname']
	]
*/
class DTables extends Controller
{
	
	public static function make( $eloquent, $data, $columns )
	{
		
		$iTotalRecords = self::getMaxPages( $eloquent, $data );

		$iDisplayLength = intval( $_REQUEST['length'] );
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval( $_REQUEST['start'] );
		$sEcho = intval( $_REQUEST['draw'] );

		$results = self::get( $data, $eloquent, $columns, $iDisplayStart, $iDisplayLength );

		$records[ 'data' ] = array(); 

		$viewParseRegex = '/@view\:/';

		foreach ( $results as $rows ) 
		{
			$item = array();


			foreach ( $columns as $column )
			{
				if ( preg_match( $viewParseRegex, $column ) )
				{
					$item[] = view( trim( preg_replace( $viewParseRegex, '', $column ) ), [ 'data' => $rows ] )->render();
				}
				else
				{
					$item[] = !empty($rows->$column) ? $rows->$column : '';
					// $item[] = $rows->$column[$i];
				}
			}

			$records["data"][] = $item;
		}

		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;

		return $records;
	}

	/* GET ALL RECORDS */
	public static function get( $data, $eloquent, $columns, $iDisplayStart, $iDisplayLength )
	{

		$query = $eloquent::query();

		if( !empty( $data['with'] ) )
		{
			// $with = implode(',', $data['with']);
			$with = $data['with'];
			$query->with($with);
		}

		if( !empty( $data['whereHas'] ) )
		{
			foreach ($data['whereHas'] as $key => $where) {
				if( !empty( $where[2] ) || $where[2] != '' ){
					$query->orWhereHas($key, function($q) use ($where) {
					    $q->where( $where[0], $where[1], $where[2] );
					});
				}
					
			}
			
		}





		/* MULTIPLE WHERES */
		if( !empty( $data['where'] ) )
		{
			foreach ($data['where'] as $key => $where) {
				
				if( $where[0] == 'like' && $where[1] != '' ){
					$query->where( $key, $where[0], '%' .$where[1] . '%' );
				} else if($where[0] == 'or') {
					$query->orWhere( $key, $where[1] );	
				} else if($where[0] == 'orLike') {
					$query->orWhere( $key, 'like', '%' .$where[1] . '%' );	//added condition (adm)
				} else {
					if( $where[1] != '' ){
						$query->where( $key, $where[0], $where[1] );	
					} else {
						// $query->where( $key, $where[0], $where[1] );
					}
					
				}
				
			}
		}

	
		if( !empty( $data['columnSearch'] ) )
		{
			if( count( $data['columnSearch'] ) > 1 )
			{
				for( $i = 0; $i <= count( $data['columnSearch'] ); $i++ )
				{
					if( $i == 0 )
					{
						$query->where( $data[ 'columnSearch' ][ $i ], 'LIKE', '%'.$_GET[ 'sSearch' ].'%' );
					}
					else
					{
						$query->orWhere( $data[ 'columnSearch' ][ $i ], 'LIKE', '%'.$_GET[ 'sSearch' ].'%' );
					}
				}
			}
			else
			{
				$query->where( $data[ 'columnSearch' ][0], 'LIKE', '%'.$_GET[ 'sSearch' ].'%' );
			}
			
		}

		if( !empty( $data['customSearch'] ) )
		{
			$ctr = 1;
			foreach ( $data['customSearch'] as $search => $customSearch ) 
			{
				// foreach ($customSearch as $field => $search_type) 
				// {
					if( $ctr == 1 )
					{
						if( $customSearch[1] == 'LIKE' )
							$query->where( $customSearch[0], 'LIKE', '%'.$search.'%' );
						else
							$query->where( $customSearch[0], $customSearch[1], $search );

					}
					else
					{
						if( $customSearch[1] == 'LIKE' )
							$query->where( $customSearch[0], 'LIKE', '%'.$search.'%' );
						else
							$query->where( $customSearch[0], $customSearch[1], $search );

					}

					$ctr++;
					
				// }
				
			}
		}

		if( isset( $data['order']['orderByFieldName'] ) )
		{
			$query->orderBy( $data['order']['orderByFieldName'], $data['order']['sortBy']  );
		}

		return $query->skip( $iDisplayStart )->take( $iDisplayLength )->get();	
	}

	public static function getMaxPages( $eloquent, $data )
	{

		$query = $eloquent::query();

		if( !empty( $data['with'] ) )
		{
			// $with = implode(',', $data['with']);
			$with = $data['with'];
			$query->with($with);
		}


		if( !empty( $data['whereHas'] ) )
		{
			foreach ($data['whereHas'] as $key => $where) {
				if( !empty( $where[2] ) || $where[2] != '' ){
					$query->orWhereHas($key, function($q) use ($where) {
					    $q->where( $where[0], $where[1], $where[2] );
					});
				}
					
			}
			
		}




		if( !empty( $data['columnSearch'] ) )
		{
			if( count( $data['columnSearch'] ) > 1 )
			{
				for( $i = 0; $i <= count( $data['columnSearch'] ); $i++ )
				{
					if( $i == 0 )
					{
						$query->where( $data[ 'columnSearch' ][ $i ], 'LIKE', '%'.$_GET[ 'sSearch' ].'%' );
					}
					else
					{
						$query->orWhere( $data[ 'columnSearch' ][ $i ], 'LIKE', '%'.$_GET[ 'sSearch' ].'%' );
					}
					
				}
			}
			else
			{
				$query->where( $data[ 'columnSearch' ][0], 'LIKE', '%'.$_GET[ 'sSearch' ].'%' );
			}
			
		}

		// foreach ( $data['customSearch'] as $search => $customSearch ) 
		// 	{
		// 		echo $customSearch[0];
		// 	}

		// print_r( $data['customSearch'] );

		if( !empty( $data['customSearch'] ) )
		{
			$ctr = 1;
			foreach ( $data['customSearch'] as $search => $customSearch ) 
			{
				// foreach ($customSearch as $field => $search_type) 
				// {
					if( $ctr == 1 )
					{
						if( $customSearch[1] == 'LIKE' )
							$query->where( $customSearch[0], 'LIKE', '%'.$search.'%' );
						else
							$query->where( $customSearch[0], $customSearch[1], $search );

					}
					else
					{
						if( $customSearch[1] == 'LIKE' )
							$query->where( $customSearch[0], 'LIKE', '%'.$search.'%' );
						else
							$query->where( $customSearch[0], $customSearch[1], $search );

					}

					$ctr++;
					
				// }
				
			}
		}

		

		/* MULTIPLE WHERES */
		if( !empty( $data['where'] ) )
		{
			foreach ($data['where'] as $key => $where) {
				
				if( $where[0] == 'like' && $where[1] != '' ){
					$query->where( $key, $where[0], '%' .$where[1] . '%' );	
				} else if($where[0] == 'or') {
					$query->orWhere( $key, $where[1] );	
				} else {
					if( $where[1] != '' ){
						$query->where( $key, $where[0], $where[1] );	
					} else {
						/*if( $onLoadDisplay == true )
						{
							$query->where( $key, $where[0], $where[1] );
						}*/
					}
					
				}
				
			}

			return $query->count();
		}
		else
		{
			return $query->count();
		}
		
	}

	public static function formatBytes($size, $precision = 2)
	{
		$base = log($size) / log(1024);
		$suffixes = array('', 'k', 'M', 'G', 'T');   

		return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
	}



	/*
	$this->db->select( 'u.*' )
				->from( $this->eg_users . ' u' );
		if(!empty($search)){
			$this->db->where('u.username LIKE "%'.$search.'%" OR u.email LIKE "%'.$search.'%" OR u.lastname LIKE "%'.$search.'%" OR u.firstname LIKE "%'.$search.'%"');
		}
		// $this->db->group_by( 'u.id' );
		return $this->db->count_all_results();

	*/


}