Feature: Google's Search Functionality

  Scenario: Can find search results
    Given I am on "https://www.google.com/"
    When I search for "BrowserStack"
    Then I get title as "BrowserStack - Google Zoeken"

