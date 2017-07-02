# tut
The ultimate timetracker

tut is a simple to use timetracker that pushes your worklogs to JIRA.
Until there is a frontend or anything to do with authentication, you can use it as a personal tracker on the command line.

## The goal

Simplicity of use, quite clean code, modern frameworks and tools.

## Installation

### MySQL configuration

Create a mysql database and add your credentials to _.env_ in _src/backend_.
If you have no mysql running on your box, you can use the Homestead virtual machine (see _Homestead/Homestead.yaml_ for details).

### JIRA configuration

put the following variables into _.env_:

    JIRA_USER=<yourJiraUserName>
    JIRA_PASSWORD=<yourJiraPassword>
    JIRA_URL=<yourJiraUrl>
    JIRA_VERSION=2

The JIRA URL may be _https://yourdomain.atlassian.net_. The JIRA VERSION means the API version. Leave this to "2".

## How to use

In any case: Go to _src/backend_ and use laravel's _artisan_ command line to call various functions (see below).
Be even nicer to yourself and create nifty shell aliases.

### Configure JIRA connection

Add the following keys to your .env file.

### Track new times

    $ php artisan entry:add <duration> <ticket> <comment>

You can use JIRA durations, e.g. "2h 30m" as duration, or use autodetection with "auto", which makes your current log end now and start from where your today's last log ended. Use "auto/15" or "auto/30" to quantize your spent time.

### Show today's worklog

    $ php artisan entry:today

### Show this week's worklog

    $ php artisan entry:week

### Delete a worklog entry

    $ php artisan entry:delete <id>

Attention: Your JIRA worklog will not (yet) be deleted.

### Export your worklog to CSV

    $ php artisan entry:export <period>

You can specify your period with YYYYmm, e.g. 201706.

