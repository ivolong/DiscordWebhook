<?php

/**
 * Import the Discord Webhook helper from the correct directory
 * Enter your webhook URL
 */
require 'DiscordWebhook.php';

$webhook_url = 'https://discord.com/api/webhooks/<id>/<token>';

/**
 * Create the webhook
 * Add the basic parameters
 */
$message = new DiscordWebhook($webhook_url);
$message->content('Content @here')
    ->allowed_mentions(['everyone', 'roles', 'users']) // Array of mention types the message can ping. Default: all types allowed (you can probably delete this line).
    ->username('Username')
    ->avatar_url('http://image.url')
    ->textToSpeech();                                  // Allows Discord to read the content out loud for /tts users & channels. Default: off (leave this line here for /tts).

/**
 * Optionally construct an embed
 */
$builder = new EmbedBuilder();
$builder->title('Title')
    ->title_url('https://github.com/ivolong')
    ->description('Description')
    ->footer([
        'text' => 'Footer',
        'icon_url' => 'http://image.url'
    ])
    ->thumbnail('http://image.url')
    ->image('http://image.url')
    ->author([
        'name' => 'Author',
        'url' => 'https://github.com/ivolong',
        'icon_url' => 'http://image.url'
    ])
    ->addField([
        'name' => 'Field 1',
        'value' => 'Value 1',
        'inline' => true
    ])
    ->addField([
        'name' => 'Field 2',
        'value' => 'Value 2',
        'inline' => true
    ])
    ->timestamp()                                      // ISO8601 timestamp. Default: current timestamp. Delete this line for no timestamp.
    ->color(0);                                        // Color as integer

/**
 * Build the embed and add it to the message
 * Send the message to Discord
 */
$message->addEmbed($builder->embed);

$response = $message->send();

/**
 * Print the response from the Discord API (i.e. errors)
 */
echo $response;