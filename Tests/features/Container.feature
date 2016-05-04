Feature: Check container
  Background:
    Given Retrieve Radio manager

Scenario Outline: Check if Radio are available and get Try get hits from  HitPages
  When I read all hit pages from "<radio>", i must found "<nbitems>"
  Examples:
    | radio              | nbitems|
    | NrjAntilles        | 25     |
    | TraceFmGP          | 70     |
    | Mfm                | 50     |
    | TraceFmGPTopClip   | 20     |
    | TraceFmGPClipNew   | 80     |
