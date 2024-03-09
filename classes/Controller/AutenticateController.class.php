<?php

class AutenticateController extends Controller {
    
    public function show($email) {
        $fitxerDeTraduccions = "lang/es.php";
        
        AutenticateView::show($fitxerDeTraduccions, $email);
            
    }
    
    public function update($email) {
        $db = new UserModel();
        
        $db->update($email);
        
        header("Location: ?Home/show");   
        
    }
    
}

