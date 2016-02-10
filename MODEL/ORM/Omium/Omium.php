<?php

namespace OmiumORM;

interface Omium {
    
    /** Make an update on database
     * 
     */
    public function update() ;
       
    
    
      /** delete comparison on database
     * 
     */
    public function delete() ;
    
    
    /** Create a new comparison
     * 
     */
    public function create() ;
    

    /** Search an item by id
     */
   public function getItem();

    
}