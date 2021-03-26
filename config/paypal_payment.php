<?php

return [
    # Define your application mode here
    'mode' => 'sandbox',

    # Account credentials from developer portal
    'account' => [
        'client_id' => env('PAYPAL_CLIENT_ID', 'AT5CxLEhal5EW0YCQ8Aj6NjRg27V0qIyZAWYTX17Zg6KcccP-WlGWhHJw9W40A16WMvlOc3Z7MkRgtSB'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET', 'EN3bUMg1bDv_Ze-YhUAdc5ZHI3JFgw0krC-C6KmUndJdgdznN5R7Do9aamTASTtFxIDyeAJwnileFFrg'),
    ],
   
    # Connection Information
    'http' => [
        'connection_time_out' => 30,
        'retry' => 1,
    ],

    # Logging Information
    'log' => [
        'log_enabled' => true,

        # When using a relative path, the log file is created
        # relative to the .php file that is the entry point
        # for this request. You can also provide an absolute
        # path here
        'file_name' => '../PayPal.log',

        # Logging level can be one of FINE, INFO, WARN or ERROR
        # Logging is most verbose in the 'FINE' level and
        # decreases as you proceed towards ERROR
        'log_level' => 'FINE',
    ],
];
