# Scale Manager Overview

_Insert photo here_

## Dataflow


###Instance
The instances sends the collected states to the collector.
The payload includes:
- type (ram, load, storage_usage)
- value
- timestamp

###Collector
The collector sends the data to the history and puts the data (state) in the queue for processing by the manager.

###History
The history is responsible for managing the eventlog. It stores any new states that were sent from the collector.
History data stored:
- type
- value
- timestamp
- instance

Furthermore it provides a function for querying the eventlog data and returns a boolean if there is a match.
Required parameter for the query:
- instance
- timestamp_start
- timestamp_end
- value
- condition

###Manager
The manager polls the queue for new events. The event type is used to check if any rule applies. 
First the actionlog will be checked if there is any action of the same type active. 
If an action of the same type is active the event will be skipped.
Otherwise all applying rules will be loaded. If the rule applies an entry in the action log will be created and the command dispatched.

Command (each class has an action, e.g. cpu upsize):
- instance
- type (abs, rel, percent)
- value

Actionlog:
- command
- instance
- timestamp_start
- timestamp_end
- event

###Cleaner
The cleaner processes the action log to create new state messages to action which are in a possible faile state.
Deletes old eventlog entries and aggregates them in an archive
