Feature: T3EE Voting Example, maintenance
  In order to maintain the votings shown on the site
  As a Frontend User
  I need to be able to list topics with minor voting informations

  Scenario: Check if page "List Topics" will be loaded
    Given I am on the homepage
    Then I should see the headline "Listing for Topic"

  Scenario: List available votes
    Given there are 5 votes
    And I am on the homepage
    Then I should see 5 votes
