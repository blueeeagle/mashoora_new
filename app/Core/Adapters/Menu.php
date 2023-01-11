<?php

namespace App\Core\Adapters;

/**
 * Adapter class to make the Metronic core lib compatible with the Laravel functions
 *
 * Class Menu
 *
 * @package App\Core\Adapters
 */
class Menu extends \App\Core\Menu
{
    public function build()
    {
        ob_start();

        parent::build();

        return ob_get_clean();
    }

    /**
     * Filter menu item based on the user permission using Spatie plugin
     *
     * @param $array
     */
    public static function filterMenuPermissions(&$array)
    {

        if (!is_array($array)) {
            return;
        }

        $user = auth()->user();
        $permissions=explode(',',$user->permission);

        $checkPermission = $checkRole = false;
        if (auth()->check()) {
            // check if the spatie plugin functions exist
            $checkPermission = method_exists($user, 'hasAnyPermission');
            $checkRole       = method_exists($user, 'hasAnyRole');
        }

        foreach ($array as $key => &$value) {   
            
            if(!in_array('Admin',$permissions))
            {
                if($key==2){ unset($array[$key]);}
            }
            
            if(in_array('Currency',$permissions) || in_array('Country',$permissions) || in_array('State',$permissions) || in_array('City',$permissions) || in_array('Document',$permissions) || in_array('Language',$permissions) || in_array('Tax',$permissions) || in_array('Category',$permissions) || in_array('Specialization',$permissions))
            {
                if($key==3){ 
                    
                    if (is_callable($value)) 
                    {
                        continue;
                    }

                    if (is_array($value)) {
                            self::filterMenuPermissions($value);
                    }               
                
                }
            }else{
                if($key==3){ unset($array[$key]);}
            }

            if($key==3)
            {
                if(!in_array('Currency',$permissions))
                {
                    unset($value['sub']['items'][0]);
                } 
    
                if(!in_array('Country',$permissions))
                {
                    unset($value['sub']['items'][1]);
                } 
                if(!in_array('State',$permissions))
                {
                    unset($value['sub']['items'][2]);
                } 
                if(!in_array('City',$permissions))
                {
                    unset($value['sub']['items'][3]);
                } 
                if(!in_array('Document',$permissions))
                {
                    unset($value['sub']['items'][4]);
                } 
                if(!in_array('Language',$permissions))
                {
                    unset($value['sub']['items'][5]);
                } 
                if(!in_array('Tax',$permissions))
                {
                    unset($value['sub']['items'][6]);
                } 
                if(!in_array('Category',$permissions))
                {
                    unset($value['sub']['items'][7]);
                } 
                if(!in_array('Specialization',$permissions))
                {
                    unset($value['sub']['items'][8]);
                }
            }            

            if(!in_array('Company_Settings',$permissions))
            {
                if($key==4){ unset($array[$key]);}
            }

            if(!in_array('Company_Settings',$permissions))
            {
                if($key==4){ unset($array[$key]);}
            }

            if(in_array('Firm',$permissions) || in_array('Insurance',$permissions) || in_array('Customer',$permissions))
            {
                if($key==5){ 
                    
                    if (is_callable($value)) 
                    {
                        continue;
                    }

                    if (is_array($value)) {
                            self::filterMenuPermissions($value);
                    }               
                
                }
            }else{
                if($key==5){ unset($array[$key]);}
            }


            if($key==5)
            {
                if(!in_array('Firm',$permissions))
                {
                    unset($value['sub']['items'][0]);
                }

                if(!in_array('Insurance',$permissions))
                {
                    unset($value['sub']['items'][1]);
                }

                if(!in_array('Customer',$permissions))
                {
                    unset($value['sub']['items'][2]);
                }
            }

            if(in_array('Article',$permissions) || in_array('Video',$permissions) || in_array('Offer',$permissions) || in_array('Discount',$permissions) || in_array('Communication',$permissions))
            {
                if($key==6){ 
                    
                    if (is_callable($value)) 
                    {
                        continue;
                    }

                    if (is_array($value)) {
                            self::filterMenuPermissions($value);
                    }               
                
                }
            }else{
                if($key==6){ unset($array[$key]);}
            }

            if($key==6)
            {
                if(!in_array('Article',$permissions))
                {
                    unset($value['sub']['items'][0]);
                }

                if(!in_array('Video',$permissions))
                {
                    unset($value['sub']['items'][1]);
                }

                if(!in_array('Offer',$permissions))
                {
                    unset($value['sub']['items'][2]);
                }

                if(!in_array('Discount',$permissions))
                {
                    unset($value['sub']['items'][3]);
                }

                if(!in_array('Communication',$permissions))
                {
                    unset($value['sub']['items'][4]);
                }                
            }

            if(!in_array('Consultant',$permissions))
            {
                if($key==7){ unset($array[$key]);}
            }

            if(in_array('Schedule',$permissions) || in_array('Config',$permissions))
            {
                if($key==8){ 
                    
                    if (is_callable($value)) 
                    {
                        continue;
                    }

                    if (is_array($value)) {
                            self::filterMenuPermissions($value);
                    }               
                
                }
            }else{
                if($key==8){ unset($array[$key]);}
            }

            if($key==8)
            {
                if(!in_array('Schedule',$permissions))
                {
                    unset($value['sub']['items'][0]);
                }

                if(!in_array('Config',$permissions))
                {
                    unset($value['sub']['items'][1]);
                    unset($value['sub']['items'][2]);
                }             
            }

            if(in_array('Consultant_Approval',$permissions) || in_array('Firm_Approval',$permissions))
            {
                if($key==9){ 
                    
                    if (is_callable($value)) 
                    {
                        continue;
                    }

                    if (is_array($value)) {
                            self::filterMenuPermissions($value);
                    }               
                
                }
            }else{
                if($key==9){ unset($array[$key]);}
            }

            if($key==9)
            {
                if(!in_array('Consultant_Approval',$permissions))
                {
                    unset($value['sub']['items'][0]);
                    unset($value['sub']['items'][1]);
                    unset($value['sub']['items'][2]);
                }

                if(!in_array('Firm_Approval',$permissions))
                {
                    unset($value['sub']['items'][3]);
                }
            }

            // if (is_callable($value)) {
            //     continue;
            // }

            // if ($checkPermission && isset($value['permission']) && !$user->hasAnyPermission((array) $value['permission'])) {
            //     unset($array[$key]);
            // }

            // if ($checkRole && isset($value['role']) && !$user->hasAnyRole((array) $value['role'])) {
            //     unset($array[$key]);
            // }

            // if (is_array($value)) {
            //     self::filterMenuPermissions($value);
            // }
        }
    }
}
