<?php

namespace App\Library;


use Illuminate\Http\Response;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/*
*   Usage: 
*	$data[ 
*		'where' => [ 'FIELD_NAME' => ['type','value'] ], 
*		'columnSearch' => ['FIELD_NAME'], 
*		'customSearch' => [ 'TYPE eg.(LIKE or < or >)', 'FIELD_NAME' ],
*		'order' => [ 'sortBy' => 'ASC/DESC', 'orderByFieldName' => 'FIELD_NAME' ],
*	]
*/

class DataTables extends Controller
{
	/**
	 * [make description]
	 * @param  [array] $eloquent [model name with corresponding destinale eg App\Models\ModelName]
	 * @param  [array] $data     [contains of following 'where', 'customSearch', 'columnSearch', 'order']
	 * @param  [array] $columns  [columns]
	 */
	public static function make( $eloquent, $data, $columns, $onLoadDisplay = false )
	{
		
		$iTotalRecords = self::getMaxPages( $eloquent, $data, $onLoadDisplay );

		$iDisplayLength = intval( $_GET[ 'iDisplayLength' ] );
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval( $_GET[ 'iDisplayStart' ] );
		$sEcho = intval( $_GET[ 'sEcho' ] );

		$results = self::get( $data, $eloquent, $columns, $iDisplayStart, $iDisplayLength, $onLoadDisplay );

		$records[ 'aaData' ] = array(); 

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

			$records["aaData"][] = $item;
		}

		$records["sEcho"] = $sEcho;
		$records["iTotalRecords"] = $iTotalRecords;
		$records["iTotalDisplayRecords"] = $iTotalRecords;

		return $records;
	}

	/* GET ALL RECORDS */
	public static function get( $data, $eloquent, $columns, $iDisplayStart, $iDisplayLength, $onLoadDisplay )
	{

		$query = $eloquent::query();

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
						if( $onLoadDisplay == true )
						{
							$query->where( $key, $where[0], $where[1] );
						}
					}
					
				}
				
			}
		}

		
		if( !empty( $data['columnSearch'] ) )
		{
			if( count( $data['columnSearch'] ) > 1 )
			{
				for( $i = 0; $i <= count( $data['columnSearch'] )- 1; $i++ )
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

	public static function getMaxPages( $eloquent, $data, $onLoadDisplay )
	{

		$query = $eloquent::query();

		if( !empty( $data['columnSearch'] ) )
		{
			if( count( $data['columnSearch'] ) > 1 )
			{
				for( $i = 0; $i <= count( $data['columnSearch'] ) - 1; $i++ )
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
						if( $onLoadDisplay == true )
						{
							$query->where( $key, $where[0], $where[1] );
						}
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