Feature: T3EE Voting Example, maintenance
  In order to maintain the votings shown on the site
  As a Frontend User
  I need to be able to delete existing topics

  Scenario: Deleting a topic
    Given there are 5 topics
    And there is a topic labeled "Do you like ..." having 2 votes
    And I am on the homepage
    When I press the "Delete" link at the topic "Do you like ..."
    Then I should see "The topic was deleted"
    And I should see 5 topics
    And I should not see "Do you like ..."
