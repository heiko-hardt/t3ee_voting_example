Feature: T3EE Voting Example, maintenance
  In order to maintain the topics shown on the site
  As a Frontend User
  I need to be able to edit existing topics

  Scenario: Editing an existing topic
    Given there is a topic labeled "Do you like ..." having 2 votes
    And I am on the homepage
    And I should not see "Don't you like"
    When I press the "Edit" link at the topic "Do you like ..."
    And I fill in "Issue" with "Don't you like ..."
    And I press "Save"
    Then I should see "Don't you like"
