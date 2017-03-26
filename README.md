# ScaleManager

The ScaleManager oversees multiple VM instances and scales them correpsonding to a predefined ruleset.

It consists of multiple micro-services:
* **Daemon** service running on multiple VM instances reporting states in a predefined period of time
* **Daemon-API** receiving commands from the manager, builds commands usable by the environment the api runs on for the needed call (e.g. resize API-Call to Hoster)
* **Collectors** collecting all the data from the daemons, sending the data to the history and the queue which serves the data to the manager
* **History** receives data to store it in the connected EventLog (MySQL Database)
* **Queue** stream based queue to provide the event data to the manager for an ordered processing
* **Manager** this component manages the information retrieved by the queue. Based on predefined rules it desides whether there is any action to take or not.
  * A question to the history will be sent to retrieve informations for the rule matching the event coming from the queue
  * The answer helps to deside whether a command for resizing an instance is triggered or not.
  * Triggered commands will be inserted into the ActionLog, blocking any further rules that match the same event type to trigger the next command execution
  * After inserting into the ActionLog the command will be sent to the Instance or API managing the instances to take further actions
  * If the command could not be executed the manager also has the possibility to generate alerts, which can be retrieved via different endpoints (mail, chat, etc.)
* **Cleaner** The cleaner moves old date from the EventLog and the ActionLog to the archive with the goal to keep the index on those databases small