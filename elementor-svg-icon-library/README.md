# SVG Icon Library for Elementor

Adds a custom SVG icon library as a new tab in Elementor's icon picker.

## Install
- Copy the `elementor-svg-icon-library` folder to `wp-content/plugins/`.
- Activate the plugin in WordPress.
- Ensure Elementor is active.

## Usage
- In Elementor, open any icon control, then open the icon picker.
- Select the tab labeled "SILE Icons".

## Add your icons (SVG)
- Put individual SVG files into: `assets/svg/`
- Run a small build step or manually update the JSON file `assets/sile-icons.json` to include your icons (this repo includes a starter JSON).
- The icon name is derived from the filename (e.g., `arrow-right.svg` => `arrow-right`).
- SVG requirements:
  - Include a proper `viewBox` (e.g., `viewBox="0 0 24 24"`).
  - Inner paths should use `currentColor` for color inheritance.
  - Outer `<svg>` tag will be stripped automatically if you generate JSON programmatically.

## How it works
- Elementor loads icons via a static JSON file defined by `fetchJson`.
- The JSON lives at `assets/sile-icons.json` and contains an Iconify-like format:

```json
{
  "prefix": "sile",
  "icons": {
    "check": { "body": "<path ... />", "width": 24, "height": 24 }
  }
}
```

## Notes
- If you prefer dynamic generation, you can restore the previous AJAX endpoint and point `fetchJson` to it.