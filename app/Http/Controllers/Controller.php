<?php

namespace app\http\controllers;

use illuminate\foundation\auth\access\authorizesrequests;
use illuminate\foundation\bus\dispatchesjobs;
use illuminate\foundation\validation\validatesrequests;
use illuminate\routing\controller as basecontroller;

class controller extends basecontroller
{
    use authorizesrequests, dispatchesjobs, validatesrequests;
}
