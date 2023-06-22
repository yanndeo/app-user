#features/Auth.feature
Feature:
    Scenario: Call a not found route
        When I add "Content-Type" header equal to "application/json"
        And I send a "GET" request to "/api/v1/not-found-route"
        Then the response status code should be 404

    Scenario: Try to register a user with missing "password" field
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/v1/register" with body:
        """
        {
            "email": "jhon.doe@gmail.com",
        }
        """
        Then the response status code should be 400
        And the response should be in JSON
        And the JSON node "message" should be equal to the string "password The password field is required.."

    Scenario: Successfully register a new user
        When I add "Content-Type" header equal to "application/json"
        And I send a "POST" request to "/api/v1/register" with body:
        """
        {
            "email": "jhon.doe@gmail.com",
            "password": "test-pass",
        }
        """
        Then the response status code should be 201
        And the response should be in JSON
        And the JSON node "id" should not be null
        And the JSON node "email" should be equal to the string "jhon.doe@gmail.com"
        And the JSON node "token" should not be null
