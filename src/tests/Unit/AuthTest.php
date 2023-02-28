<?php

namespace Tests\Unit;

use Tests\TestCase;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AuthTest extends TestCase
{
    public function testVerifyToken()
    {
        $idTokenString = "eyJhbGciOiJSUzI1NiIsImtpZCI6IjE1YzJiNDBhYTJmMzIyNzk4NjY2YTZiMzMyYWFhMDNhNjc3MzAxOWIiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL3NlY3VyZXRva2VuLmdvb2dsZS5jb20vd2FrdXdha3Utb2tpbmF3YSIsImF1ZCI6Indha3V3YWt1LW9raW5hd2EiLCJhdXRoX3RpbWUiOjE2Nzc0ODc0NDMsInVzZXJfaWQiOiJ5dUFJZExsbk1WWjJvMkNDelJLcWVzM3U5a24xIiwic3ViIjoieXVBSWRMbG5NVloybzJDQ3pSS3FlczN1OWtuMSIsImlhdCI6MTY3NzQ4NzQ0MywiZXhwIjoxNjc3NDkxMDQzLCJlbWFpbCI6ImRpcmFibHVlQGdtYWlsLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJlbWFpbCI6WyJkaXJhYmx1ZUBnbWFpbC5jb20iXX0sInNpZ25faW5fcHJvdmlkZXIiOiJwYXNzd29yZCJ9fQ.vmiy5nkyZDUr-9O6qxrgkJGw8c5MMpSfg8jNI_2toI12WIMQaHYk3Spv4aPxG7_wlArzLtTdyhnM1EV6uSKAt0KlAPTwdpkVLTfdsNoQoEmOyoP7rls8xsJetM-P3Jf9vgwAy3JvW8Bq18Fy-t21eYGT4ZGQjboEa8tv229xztye6z7y6FXgcfzdmIY2EyfCq-I1Ag0ydsgWREEloT-y0F9z3dhRTmH_b-VcfoqwlrMNoRkI43uVxw6Mufmw8VRHvpZIrZsKIFyHkyFCn7QC7_78MmQgh9AL08mXO_UBqHmG3YSyUuW4m7lcWQdCFIKbS9dfDxs0YnFTEfOFgLw4pw";
        $verifiedToken = null;

        $auth = Firebase::project('app')->auth();
        try { // Try to verify the Firebase credential token with Google
            $verifiedToken = $auth->verifyIdToken($idTokenString);
        } catch (\Exception $e) { // If the token has the wrong format
            print("401 Unauthorized - Can't parse the token: " . $e->getMessage());
            return;
        }

        $claims = $verifiedToken->claims();
        var_export($claims);
        print('user_id: ' . $claims->get('user_id'));
    }

}
