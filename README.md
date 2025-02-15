# StopReason Plugin

The **StopReason** plugin for PocketMine-MP allows server administrators to stop the server with a custom reason. Players can be notified of the reason for the server shutdown, either by being kicked with a message or simply receiving a message.

## Features

- Customizable stop reason for server shutdown.
- Configurable message format.
- Option to either kick players or send them a message upon shutdown.

## Installation

1. Download the latest release of the StopReason plugin.
2. Place the `StopReason` folder into the `plugins` directory of your PocketMine-MP server.
3. Start or restart your server to generate the default configuration file.

## Configuration

The plugin creates a `config.yml` file in the `StopReason` folder. You can customize the following settings:

- `format`: The message format displayed to players. Default is `Server Stopped{line}Reason: {reason}`.
- `type`: The type of notification sent to players. Options are `kick` (default) or `message`.

### Example Configuration

```yaml
format: "Server Stopped{line}Reason: {reason}"
type: "kick"
```
