<?php
$body = [
    'Messages' => [
        [
        'From' => [
            'Email' => "utp0156992@alumno.utpuebla.edu.mx",
            'Name' => "Alpha Dev"
        ],
        'To' => [
            [
                'Email' => "utp0156861@alumno.utpuebla.edu.mx",
                'Name' => "Cliente"
            ]
        ],
        'Subject' => "Recover Password",
        'HTMLPart' => "<h3>Dear user</h3><br />Here is your password"
        ]
    ]
];
 
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json')
);
curl_setopt($ch, CURLOPT_USERPWD, "dddc81b2e8eb8691a1d1733cbb961448:477a8db498fe36834861337312f8ada8");
$server_output = curl_exec($ch);
curl_close ($ch);
 
$response = json_decode($server_output);
if ($response->Messages[0]->Status == 'success') {
    echo "Email sent successfully.";
}