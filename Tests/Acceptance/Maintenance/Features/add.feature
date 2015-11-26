Feature: T3EE Voting Example, maintenance
  In order to maintain the topic shown on the site
  As a Frontend User
  I need to be able to add new topics

  Scenario: Adding a new topic
    Given I am on the homepage
    When I follow "New Topic"
    And I fill in "Issue" with "What do you think about..."
    And I fill in "Yes" with "5"
    And I fill in "No" with "2"
    And I press "Create new"
    Then I should see "The topic was created."
    And I should see "What do you think about..."
