Feature: T3EE Voting Example, maintenance
  In order to maintain the votings shown on the site
  As a Frontend User
  I need to be able to list topics with voting informations

  Scenario: List all available topic
    Given there are 5 topics
    And I am on the homepage
    Then I should see 5 topics

  Scenario: List available votes with linked attendees
    Given there is a topic labeled "Do you like ..." having 5 votes
    And I am on the homepage
    Then I should see the topic "Do you like ..." and 5 votes
