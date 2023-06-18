Feature: User 
  As an API client
  need to be able to manage users

  Scenario: GEt a Collection of users
    Given users exist
    When I request "Get" "/api/users"
    Then the response status code should be 200
    And the "users" property be an array
    And the "users" property not should be empty