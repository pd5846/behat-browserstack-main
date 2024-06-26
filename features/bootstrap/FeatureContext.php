<?php

require "vendor/autoload.php";

class FeatureContext extends BrowserStackContext {
  /** @Given /^I am on "([^"]*)"$/ */
  public function iAmOnSite($url) {
    self::$driver->get($url);
    $element = self::$driver->findElement(WebDriverBy::id("W0wltc"));
    $element->sendKeys(WebDriverKeys::ENTER);
    sleep(5);
  }

  /** @When /^I search for "([^"]*)"$/ */
  public function iSearchFor($searchText) {
    $element = self::$driver->findElement(WebDriverBy::name("q"));
    $element->sendKeys($searchText);
    $element->sendKeys(WebDriverKeys::ENTER);
    sleep(5);
  }

    /** @Then /^I get title as "([^"]*)"$/
     * @throws Exception
     */
  public function iShouldGet($string) {
    $title = self::$driver->getTitle();
    /**if ((string)  $string !== $title) {
       throw new Exception("Expected title: '". $string. "'' Actual is: '". $title. "'");
    }**/
      if ((string)  $string == $title){
          self::$driver->executeScript('browserstack_executor: {"action": "setSessionStatus", "arguments": {"status":"passed", "reason": "Title matched!"}}' );
      }  else {
          self::$driver->executeScript('browserstack_executor: {"action": "setSessionStatus", "arguments": {"status":"failed", "reason": "Title not matched!"}}');
      }
  }

    /** @Then /^I should see "([^"]*)"$/
     * @throws Exception
     */
  public function iShouldSee($string) {
    $source = self::$driver->getPageSource();
    if (strpos($source, $string) === false) {
      throw new Exception("Expected to see: '". $string. "'' Actual is: '". $source. "'");
    }
  }
}
