<?php

use App\Models\User;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }


    /**
     * @Given users exist
     */
    public function usersExist()
    {
        $users = User::all();
        if (count($users) > 0) return true;
        else throw new Exception('users not exist');
    }


    /**
     * @When I request :arg1 :arg2
     */
    public function iRequest($arg1, $arg2)
    {
        /* $client = new GuzzleHttp\Client(['verify' => false, 'base_uri' => 'http://backend']);

        $response = $client->get('/api/users'); */

        $response = Http::get('http://localhost:9000/api/users');


        $response->assertStatus(200);


        if ($response->getStatusCode() !== 200) {
            throw new Exception(" Failed to retrieve users from API");
        }

        return true;
    }

    /**
     * @Then the response status code should be :arg1
     */
    public function theResponseStatusCodeShouldBe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the :arg1 property be an array
     */
    public function thePropertyBeAnArray($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the :arg1 property not should be empty
     */
    public function thePropertyNotShouldBeEmpty($arg1)
    {
        throw new PendingException();
    }
}
