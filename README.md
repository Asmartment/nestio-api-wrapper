# Nestio API Package

## Installation

`composer require primitivesocial/nestio-api-wrapper`

`php artisan vendor:publish` to publish the config

## Configuration

Add `NESTIO_API_KEY=` to your .env with your Nestio API key.

## Methods

### Listings

To use the Listings object, include `use PrimitiveSocial\NestioApiWrapper\Listings;` in your file.

#### Get All Listings

Nestio API Link: [https://developers.nestio.com/api/v2/listings.html#listings-search](https://developers.nestio.com/api/v2/listings.html#listings-search)

```
$client = new Listings($apiKey);

$output = $client->all();
```

##### Params

These are called as chainable functions off of your clients. Example:
```
$client->commercialUse('industrial')
        ->listingType('sales')
        ->hasPhotos()
        ->all();
```

Here is the list:
- agents
- geometry
- listingType
- propertyType
- commercialUse
- building
- buildingNameAddress
- buildingOwnership
- company
- exclusive
- minPrice
- maxPrice
- elevator
- doorman
- pets
- layout
- bathrooms
- neighborhoods
- postalCode
- dateAvailableBefore
- dateAvailableAfter
- hasPhotos
- incentives
- openHouseBegin
- openHouseEnd
- featured
- source
- city
- isRenovated
- dishwasher
- microwave
- exposedBrick
- hardwoodFloors
- virtualDoorman
- storage
- shortTerm
- liveInSuper
- lastListedAtBefore
- lastListedAtAfter
- parking
- includePrivate
- sort
- displayAgent

Boolean parameters can be called without any parameters; the package will assume that, if you are calling it, you want it. You can also specify `false`.

#### byId

Nestio API Documentation here: [https://developers.nestio.com/api/v2/listings.html#single-listing](https://developers.nestio.com/api/v2/listings.html#single-listing)

This is for specific listings you would want to see. All of the above parameters can be called as well.

```
$client = new Listings('APIKEY');

$output = $client->all();

$listingFromOutput = $output['items'][0];

$listing = $client->byId($listingFromOutput['id']);
```

#### residentialRentals

This function acts as the `all` function, getting all residential rentals.
```
$client = new Listings($apiKey);

$output = $client->residentialRentals();
```

#### residentialSales

This function acts as the `all` function, getting all residential sales
```
$client = new Listings($apiKey);

$output = $client->residentialSales();
```

#### commercialRentals

This function acts as the `all` function, getting all commercial rentals
```
$client = new Listings($apiKey);

$output = $client->commercialRentals();
```

#### commercialSales

This function acts as the `all` function, getting all commercial sales
```
$client = new Listings($apiKey);

$output = $client->commercialSales();
```

### Agents

To use the Agents object, include `use PrimitiveSocial\NestioApiWrapper\Agents;` in your file.

#### Get All Agent

Nestio API Link: [https://developers.nestio.com/api/v2/agents.html#company-agents](https://developers.nestio.com/api/v2/agents.html#company-agents)

```
$client = new Agents('APIKEY');

$output = $client->all();
```

There are no parameters assigned to this call.

#### Get Agent By ID

Nestio API Link: [https://developers.nestio.com/api/v2/agents.html#single-agent](https://developers.nestio.com/api/v2/agents.html#single-agent)

```
$output = $client->all();

$this->assertNotNull($output);

$agentFromInitial = $output['items'][0];

$agent = $client->byId($agentFromInitial['id']);
```

There are no parameters assigned to this call.

### Buildings

To use the Buildings object, include `use PrimitiveSocial\NestioApiWrapper\Buildings;` in your file.

Nestio API Link: [https://developers.nestio.com/api/v2/buildings.html](https://developers.nestio.com/api/v2/buildings.html)

```
$client = new Buildings('APIKEY');

$output = $client->all();
```

There are no parameters for this call.

### Neighborhoods

To use the Neighborhoods object, include `use PrimitiveSocial\NestioApiWrapper\Neighborhoods;` in your file.

Nestio API Link: [https://developers.nestio.com/api/v2/neighborhoods.html#neighborhoods](https://developers.nestio.com/api/v2/neighborhoods.html#neighborhoods)

```
$client = new Neighborhoods('APIKEY');

$output = $client->all();
```

#### Params
- city
- state

```
$client = new Neighborhoods('APIKEY');

$output = $client->city('Philadelphia')
                ->state('PA')
                ->all();
```

### Clients

This call is a POST call to create clients in Nestio.

To use the Clients object, include `use PrimitiveSocial\NestioApiWrapper\Clients;` in your file.

Nestio API Link :[https://developers.nestio.com/api/v2/clients.html](https://developers.nestio.com/api/v2/clients.html)

```
$client = new Clients('APIKEY');

        // Create persons
        $client->person([
            'first_name'    => 'Gerbil',
            'last_name'     => 'McPherson',
            'email'         => 'nestio@example.com',
            'phone_1'       => '215-555-5555',
            'is_primary'    => true
        ]);

        $client->person([
            'first_name'    => 'Albert',
            'last_name'     => 'Bundy',
            'email'         => 'al@example.com',
            'phone_1'       => '215-555-5551',
            'is_primary'    => false
        ]);

        $client->moveInDate('2019-06-01')
                ->group('1234')
                ->layout('1br')
                ->clientReferral('Ted McGinley')
                ->discoverySource('zillow')
                ->device('phone')
                ->sourceType('organic');

        $output = $client->submit();
```

To create a client, you must have:
- a person with a first_name and last_name
- a group number assigned.

You can add as many `person`s as needed. Each `person` function call creates a new `People` object in the client.

#### Params
- person
- moveInDate
- layout
- price_floor
- price_ceiling
- notes
- group
- brokerCompany
- brokerEmail
- brokerFirstName
- brokerLastName
- brokerPhone
- clientReferral
- campaignInfo
- unit
- discoverySource
- leadSource
- device
- sourceType

#### Client Status
You can also update the client status by using the Nestio Client ID and the status:
```
$client = new Clients('APIKEY');

$output = $client->id($nestioClientId)
                ->status($status)
                ->update();
```

Statuses can be set to:
- lead
- toured
- applicant
- resident
- not-a-prospect

## Contributing

When contributing to this repository, please first discuss the change you wish to make via issue,
email, or any other method with the owners of this repository before making a change. 

Please note we have a code of conduct, please follow it in all your interactions with the project.

### Pull Request Process

1. Ensure any install or build dependencies are removed before the end of the layer when doing a 
   build.
2. Update the README.md with details of changes to the interface, this includes new environment 
   variables, exposed ports, useful file locations and container parameters.
3. Increase the version numbers in any examples files and the README.md to the new version that this
   Pull Request would represent. The versioning scheme we use is [SemVer](http://semver.org/).
4. You may merge the Pull Request in once you have the sign-off of two other developers, or if you 
   do not have permission to do that, you may request the second reviewer to merge it for you.

### Code of Conduct

#### Our Pledge

In the interest of fostering an open and welcoming environment, we as
contributors and maintainers pledge to making participation in our project and
our community a harassment-free experience for everyone, regardless of age, body
size, disability, ethnicity, gender identity and expression, level of experience,
nationality, personal appearance, race, religion, or sexual identity and
orientation.

#### Our Standards

Examples of behavior that contributes to creating a positive environment
include:

* Using welcoming and inclusive language
* Being respectful of differing viewpoints and experiences
* Gracefully accepting constructive criticism
* Focusing on what is best for the community
* Showing empathy towards other community members

Examples of unacceptable behavior by participants include:

* The use of sexualized language or imagery and unwelcome sexual attention or
advances
* Trolling, insulting/derogatory comments, and personal or political attacks
* Public or private harassment
* Publishing others' private information, such as a physical or electronic
  address, without explicit permission
* Other conduct which could reasonably be considered inappropriate in a
  professional setting

#### Our Responsibilities

Project maintainers are responsible for clarifying the standards of acceptable
behavior and are expected to take appropriate and fair corrective action in
response to any instances of unacceptable behavior.

Project maintainers have the right and responsibility to remove, edit, or
reject comments, commits, code, wiki edits, issues, and other contributions
that are not aligned to this Code of Conduct, or to ban temporarily or
permanently any contributor for other behaviors that they deem inappropriate,
threatening, offensive, or harmful.

#### Scope

This Code of Conduct applies both within project spaces and in public spaces
when an individual is representing the project or its community. Examples of
representing a project or community include using an official project e-mail
address, posting via an official social media account, or acting as an appointed
representative at an online or offline event. Representation of a project may be
further defined and clarified by project maintainers.

#### Enforcement

Instances of abusive, harassing, or otherwise unacceptable behavior may be
reported by contacting the project team at HELLO@PRIMITIVESOCIAL.COM. All
complaints will be reviewed and investigated and will result in a response that
is deemed necessary and appropriate to the circumstances. The project team is
obligated to maintain confidentiality with regard to the reporter of an incident.
Further details of specific enforcement policies may be posted separately.

Project maintainers who do not follow or enforce the Code of Conduct in good
faith may face temporary or permanent repercussions as determined by other
members of the project's leadership.

#### Attribution

This Code of Conduct is adapted from the [Contributor Covenant][homepage], version 1.4,
available at [http://contributor-covenant.org/version/1/4][version]

[homepage]: http://contributor-covenant.org
[version]: http://contributor-covenant.org/version/1/4/

## License

MIT. See LICENSE for more information.