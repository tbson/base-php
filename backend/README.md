# Overview

This code base mostly located in `src` folder, except configurations , service provider and composer config.

In data model, we will separate big data model into small services, each service comprised by some tables. For example:

Account Service:
 - users

Role Service:
- groups
- pems
- groups_pems

Config Service:
- variables

Verify Service:
- otps
- whitelist_otps

# Rules

- There only place to get static settings: `Src/Setting`, for example: `Setting::JWT_EXPIRATION_PERIOD`

# Folder explains

## Business

Store global configuration and business rules

## Interface

Interface for services

## Service

Communicate with DB or external services (Email/SMS...)

## UseCase

Most of customer's interactions with the system identified as use cases.
The heart of use case is the flow, the main logic of use case.

In UseCase folder, we grouping use cases in 3 levels:

*Use case cluster*: Most abstract concepts that sharing between use case belongs to it. `Use case clusters` are no thing but folders that contains `use case groups` are folder too.

*Use case group*: Contains source code that actual implement use cases includes `controller`, `validator`, `flow` and `presenter`.

For example:

```
├── Auth
│   ├── BasicAuth
│   │   ├── BasicAuthCtrl.php
│   │   ├── BasicAuthValidator.php
│   │   ├── BasicAuthFlow.php
│   │   └── BasicAuthPresenter.php
│   └── Router.php
```
In above example:

*Auth*: Use case cluster (every use cases related with authentication / authorization)

*BasicAuth*: Use case group (on ly use cases that related with traditional authentication such as login, change password, reset password)

Logic flow: Controller -> Validator -> Flow -> Presenter

### UseCase Controller

*Controller*: Receive request, extract data from request, use validator to validate them. Put data and dependency services in to flow. Modify flow's result by presenter and return it.

### UseCase Validator

*Validator*: Ensure data in good shape and value.

### UseCase Flow

*Flow*: Main logic of use case. Do not import service, inject them to ensure flow is not depend to specific service/class. That way we can test and change source code easier.

### UseCase Presenter

*Presenter*: Prepare data for clients.

## Util

Utility function that reuse many place in code base such as date, string processing.
Do not interact with DB or external service, that's service's job.

# Functionalitys need to implement

## API endpoint:

1. Basic Auth Login
2. Common Auth Logout
3. Basic Auth Change PWD
4. Basic Auth Request Reset PWD
5. Basic Auth Confirm Reset PWD
6. Common Auth Refresh Check
7. Common Auth Refresh Token
8. OTP Send
9. OTP Verify
10. Account Get Profile
11. Account Update Profile
12. Variable Get List
13. Variable Get Detail
14. Variable Create
15. Variable Update
16. Variable Delete
17. Variable Delete List

API documentation: [https://documenter.getpostman.com/view/119810/2s93eWzsuH](https://documenter.getpostman.com/view/119810/2s93eWzsuH)
## Command

1. account-seeding -> backend/app/Console/Commands/CmdAccountSeeding.php -> generate account of all group for testing.
2. sync-all-pems -> backend/app/Console/Commands/CmdSyncAllPems.php -> generate and assign default groups all needed permissions.
