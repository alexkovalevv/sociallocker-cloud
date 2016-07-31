<?php
namespace common\modules\signin\handlers\lead;

use common\modules\signin\Handler;

/**
 * The class to proxy the request to the Twitter API.
 */
class LeadHandler extends Handler {

    /**
     * Handles the proxy request.
     */
    public function handleRequest() {
        
        // - context data
        
        $contextData = isset( $_POST['opandaContextData'] ) ? $_POST['opandaContextData'] : array();
        $contextData = $this->normilizeValues( $contextData );
        
        // - idetity data
        
        $identityData = isset( $_POST['opandaIdentityData'] ) ? $_POST['opandaIdentityData'] : array();
        $identityData = $this->normilizeValues( $identityData );
        
        // prepares data received from custom fields to be transferred to the mailing service
        
        $identityData = $this->prepareDataToSave( null, null, $identityData );

        //OPanda_Leads::add( $identityData, $contextData );
    }
}


