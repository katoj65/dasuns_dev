<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SecurityDocumentsModel;

class DocumentsController extends Controller
{
    //

//security documents
function get_security_documents(){
return SecurityDocumentsModel::get();
}










}
