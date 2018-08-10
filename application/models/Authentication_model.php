<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authentication_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
    }


    public function authenticateUser($email,$password){
        $this->db->where('email',$email);
		$this->db->where('password',$password);
        $users = $this->db->get('users');
        if ( $users->num_rows() > 0 ){
            return $users->result();
        }
        return array();
    }


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    public function getAllCategories(){
        $categories = $this->db->select('vc.*, ( SELECT type FROM property_types WHERE type_id = vc.category_type LIMIT 1) AS category_type ',false)
            ->from('venue_category vc')
            ->get();
        if ( $categories->num_rows() > 0 ){
            return $categories->result();
        }
        return array();
    }

    

    public function getCatgoryDetailsByID( $category_id  ){
        $category = $this->db->get_where('venue_category',array( 'category_id' => $category_id ));
        if ( $category->num_rows() > 0 ) {
            return $category->first_row();
        }
        return array();
    }

    public function getServiceDetailsByID( $service_id  ){
        $service = $this->db->get_where('venue_services',array( 'service_id' => $service_id ));
        if ( $service->num_rows() > 0 ) {
            return $service->first_row();
        }
        return array();
    }

    public function addCategory( $category_data ){
        if ( $this->db->insert('venue_category',$category_data) ) {
            return true;
        }
        return false;
    }

    public function addService( $service_data ){
        if ( $this->db->insert('venue_services',$service_data) ) {
            return true;
        }
        return false;
    }

    public function updateService( $service_data,$service_id ){
        $this->db->where('service_id',$service_id);
        if( $this->db->update('venue_services',$service_data) ){
            return true;
        }
        return false;
    }

    public function updateCategory( $category_data,$cateory_id ){
        $this->db->where('category_id',$cateory_id);
        if( $this->db->update('venue_category',$category_data) ){
            return true;
        }
        return false;
    }

    public function deleteService( $service_id ){
        $this->db->where('service_id',$service_id);
        if( $this->db->delete('venue_services') ){
            return true;
        }
        return false;
    }

    public function deleteCategory( $category_id ){
        $this->db->where('category_id',$category_id);
        if( $this->db->delete('venue_category') ){
            return true;
        }
        return false;
    }

    public function deleteVenue( $venue_id ){
        $this->db->where('venue_id',$venue_id);
        if( $this->db->delete('venues') ){
            return true;
        }
        return false;
    }

    public function getAllVenues( $user_id = '' ){
        $this->db->select('v.*,u.first_name,u.last_name,c.category as category,u.property_name ');
        $this->db->from( 'venues v' );
        $this->db->join('auth_users u','u.id = v.user_id','left');
        $this->db->join('venue_category c','c.category_id = v.category','left');
        $this->db->join('property_types up','up.type_id = u.property_type','left');

        if( $user_id != '' ){
            $this->db->where('v.user_id',$user_id);
        }

        $venues = $this->db->get();
        if( $venues->num_rows() > 0 ){
            return $venues->result();
        }
        return array();
    }

    public function getVenueDetailsById( $venue_id ){
        $venue_details = $this->db->select('v.*,u.first_name,u.email,u.last_name,u.city,u.address,u.po_box,u.company,u.phone,u.alt_phone,up.type as property_type,u.property_name,c.*')
            ->from( 'venues v' )
            ->join('auth_users u','u.id = v.user_id','left')
            ->join('venue_category c','c.category_id = v.category','left')
            ->join('property_types up','up.type_id = u.property_type')
            ->where( 'venue_id',$venue_id )
            ->get();

        if( $venue_details->num_rows() > 0 ){
            return $venue_details->first_row();
        }
        return array();
    }

    public function getVenueServices( $venue_id ){
        $venue_services = $this->db->select('vs.*,vps.created_on as created_on')->from('venue_provide_services vps')
            ->join('venue_services vs','vs.service_id = vps.service_id','left')
            ->where('vps.venue_id',$venue_id)
            ->get();
        if( $venue_services->num_rows() > 0 ){
            return $venue_services->result();
        }
        return array();
    }

    public function getVenueTimings( $venue_id ){
        $timings = $this->db->get_where('venue_timings',array( 'venue_id' =>$venue_id ));
        if( $timings->num_rows() > 0 ){
            return $timings->result();
        }
        return array();
    }

    public function getVenueRefreshments( $venue_id ){
        $refreshments = $this->db->get_where('venue_refreshments',['venue_id'=>$venue_id]);
        if( $refreshments->num_rows() > 0 ){
            return $refreshments->result();
        }
        return array();
    }

    public function getAllVenueUsers(){
        $venue_users = $this->db->select('u.id as user_id, CONCAT( u.first_name,u.last_name ) as full_name,u.property_name,u.property_type AS property_type_id,(SELECT type FROM property_types WHERE type_id = u.property_type LIMIT 1 ) AS property_type')
            ->from('auth_groups g')
            ->join('auth_users u','u.id = g.user_id','left')
            ->where('g.group_id != 1')->get();
        if( $venue_users->num_rows() > 0  ){
            return $venue_users->result();
        }
        return array();
    }

    public function addVenue( $venue_data,$venue_days,$refreshments_data = array(),$gallery_images = [],$gallery_videos = [] ){
        if( $this->db->insert('venues',$venue_data) ){
            $venue_id = $this->db->insert_id();
            if( ( $venue_id != '' || $venue_id != null || $venue_id != 0 ) && count( $venue_days ) > 0 ){
                foreach ( $venue_days as $index=>$day ){
                    $venue_days[$index]['venue_id'] = $venue_id;
                }
                $this->db->insert_batch('venue_timings',$venue_days);
            }

            if( ( $venue_id != '' || $venue_id != null || $venue_id != 0 ) && count( $refreshments_data ) > 0 ){
                foreach ( $refreshments_data as $r_index=>$refreshment_data){
                    $refreshments_data[$r_index]['venue_id'] = $venue_id;
                }
                
                $this->db->insert_batch('venue_refreshments',$refreshments_data);
            }

            if(  count($gallery_videos) > 0 ){
                foreach ( $gallery_videos as $v_index=>$video ){
                    $gallery_videos[$v_index]['venue_id'] = $venue_id;
                }
                $this->db->insert_batch('venue_videos',$gallery_videos);
            }

            if(  count($gallery_images) > 0 ){
                foreach ( $gallery_images as $i_index=>$image){
                    $gallery_images[$i_index]['venue_id'] = $venue_id;
                }

                $this->db->insert_batch('venue_images',$gallery_images);
            }

            return true;
        }
        return false;
    }

    public function updateVenue( $venue_id,$venue_data,$venue_days,$refreshments_data = array(),$gallery_images = [],$gallery_videos = [] ){
        $this->db->where('venue_id',$venue_id);
        if( $this->db->update('venues',$venue_data) ){

            if( count( $venue_days ) > 0 ){
//                $this->db->delete('venue_timings');

                foreach ( $venue_days  as $venue_day ){

                    $this->db->where(['venue_id'=>$venue_id,'day'=>$venue_day['day']]);
                    $is_available = $this->db->get('venue_timings');

                    if( $is_available->num_rows() > 0 ){
                        $this->db->where(['venue_id'=>$venue_id,'day'=>$venue_day['day']]);
                        $this->db->update('venue_timings',$venue_day);
                    }
                    else{
                        $this->db->insert('venue_timings',$venue_day);
                    }
                }
            }

            if( count( $refreshments_data ) > 0 ){

//                $this->db->delete('venue_refreshments');
                foreach ( $refreshments_data  as $refreshment_data ){

                    $this->db->where(['venue_id'=>$venue_id,'slug'=>$refreshment_data['slug']]);
                    $is_available = $this->db->get('venue_refreshments');

                    if( $is_available->num_rows() > 0 ){
                        $this->db->where(['venue_id'=>$venue_id,'slug'=>$refreshment_data['slug']]);
                        $this->db->update('venue_refreshments',$refreshment_data);
                    }
                    else{
                        $this->db->insert('venue_refreshments',$refreshment_data);
                    }
                }

            }
			if(isset($gallery_videos))
			{
				if(  count($gallery_videos) > 0 ){
					$this->db->insert_batch('venue_videos',$gallery_videos);
				}
			}

			
			

            if(  count($gallery_images) > 0 ){
				$this->db->where('venue_id', $venue_id );
			$this->db->delete('venue_images');
				 
                $this->db->insert_batch('venue_images',$gallery_images);
            
		
			}

            return true;
        }
        return false;
    }

//    public function updateVenue( $venue_data, $venue_services,$venue_id ){
//        $this->db->where('venue_id',$venue_id);
//        if( $this->db->update('venues',$venue_data) ){
//
//            $this->db->where('venue_id',$venue_id);
//            $this->db->delete('venue_provide_services');
//            $this->db->insert_batch('venue_provide_services',$venue_services);
//
//            return true;
//        }
//        return false;
//    }

    public function addVenueImages( $venue_images ){
        if( $this->db->insert_batch('venue_images',$venue_images) ){
            return true;
        }
        return false;
    }

    public function getVenueImages($venue_id){
        $venue_images = $this->db->get_where('venue_images',array('venue_id'=>$venue_id));
        if( $venue_images->num_rows() > 0 ){
            return $venue_images->result();
        }
        return array();
    }

    public function deleteVenueImage( $image_id ){
        $this->db->where('image_id',$image_id);
        if( $this->db->delete('venue_images') ){
            return true;
        }
        return false;
    }

    public function getVenueDetailsByImage( $image_id ){
        $venue_details = $this->db->select('v.*,u.first_name,u.email,u.last_name,u.city,u.address,u.po_box,u.company,u.phone,u.alt_phone,up.type as property_type,c.*')
            ->from( 'venue_images vi' )
            ->join('venues v','vi.venue_id = v.venue_id','left')
            ->join('auth_users u','u.id = v.user_id','left')
            ->join('venue_category c','c.category_id = v.category','left')
            ->join('property_types up','up.type_id = u.property_type')
            ->where( 'vi.image_id',$image_id )
            ->get();
        if( $venue_details->num_rows() > 0 ){
            return $venue_details->first_row();
        }
        return array();
    }




}
?>