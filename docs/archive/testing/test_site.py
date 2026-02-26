from playwright.sync_api import sync_playwright
import sys

with sync_playwright() as p:
    browser = p.chromium.launch(headless=True)
    page = browser.new_page()

    # Capture console logs
    console_logs = []
    page.on("console", lambda msg: console_logs.append(f"{msg.type}: {msg.text}"))

    # Capture network errors
    page.on("requestfailed", lambda request: print(f"❌ Failed: {request.url} - {request.failure}"))

    try:
        print("🔍 Testing http://dartsarena.test/fr")
        response = page.goto('http://dartsarena.test/fr', wait_until='domcontentloaded', timeout=10000)

        print(f"📊 Status: {response.status}")
        print(f"📄 URL: {response.url}")

        if response.status == 500:
            print("\n❌ HTTP 500 Error detected")
            # Try to get error content
            content = page.content()
            if "Target class [view] does not exist" in content:
                print("🔍 Error: Laravel ViewServiceProvider not loaded")
                print("💡 Solution: Les fichiers bootstrap/cache/ sont corrompus")
            else:
                print("\n📝 Page content (first 500 chars):")
                print(content[:500])
        else:
            print("✅ Page loaded successfully")
            page.wait_for_load_state('networkidle', timeout=5000)

            # Take screenshot
            page.screenshot(path='C:\\Users\\axel\\OneDrive\\Desktop\\Claude\\Site Darts\\screenshot.png', full_page=True)
            print("📸 Screenshot saved: screenshot.png")

        # Print console logs
        if console_logs:
            print("\n📋 Console logs:")
            for log in console_logs:
                print(f"  {log}")

    except Exception as e:
        print(f"❌ Error: {e}")
        sys.exit(1)
    finally:
        browser.close()
