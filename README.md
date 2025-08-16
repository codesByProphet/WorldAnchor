# WorldAnchor 🌍
Automatically returns players to a safe position when they fall! ⬇️

**WorldAnchor** is a PocketMine-MP 5 plugin that automatically teleports players back to predefined safe positions when they fall below the world boundary, preventing accidental deaths ⚠️ or getting stuck outside the world 🏰.

## Features ✨
- Automatically returns players to safe positions when they fall. ⬇️
- Fully configurable safe positions via `config.yml`. 📝

## Configuration Example 🛠️

```yaml
safe_positions:
  lobby:
    world: "lobby"
    x: 100.5
    y: 70.0
    z: 100.5
#   nether:
#     world: "nether"
#     x: 100.5
#     y: 70.0
#     z: 100.5
