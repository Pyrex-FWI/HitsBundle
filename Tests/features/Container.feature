Feature: Check container

Scenario: Check if all declared radio are available from manager
  Given Retrieve Radio manager
  Then Radio "Nrj Antilles" must be available
  Then Radio "Nrj" must be available
  Then Radio "Trace Fm GP" must be available
  Then Radio "Trace Fm MQ" must be available
