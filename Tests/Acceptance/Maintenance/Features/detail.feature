Feature: T3EE Voting Example, maintenance
  In order to maintain the topics shown on the site
  As a Frontend User
  I need to be able to edit existing topics

  Scenario: Show details of an existing topic
    Given there is a topic labeled "Do you like ..." having 2 votes
    And I am on the homepage
    When I press the "Detail" link at the topic "Do you like ..."
    Then I should see the headline "Single View for Topic"
    And I should see 2 attendees
