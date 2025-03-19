from flask import Flask, request, jsonify
from flask_cors import CORS
import torch
from PIL import Image

app = Flask(__name__)
CORS(app)

# Path to the custom weights file
model_path = r'E:\cardata\yolov5\runs\train\exp22\weights\best.pt'

# Load the YOLOv5 model with custom weights
model = torch.hub.load('ultralytics/yolov5', 'custom', path=model_path)
model.conf = 0.40

# Define a custom output mapping for all 17 classes (indices 0 to 16)
custom_labels = {
    0: "Custom Output for Class 0",
    1: "Custom Output for Class 1",
    2: "Custom Output for Class 2",
    3: "Custom Output for Class 3",
    4: "Custom Output for Class 4",
    5: "Custom Output for Class 5",
    6: "Custom Output for Class 6",
    7: "Custom Output for Class 7",
    8: "Custom Output for Class 8",
    9: "Custom Output for Class 9",
    10: "Custom Output for Class 10",
    11: "Custom Output for Class 11",
    12: "Custom Output for Class 12",
    13: "Custom Output for Class 13",
    14: "Custom Output for Class 14",
    15: "Custom Output for Class 15",
    16: "Custom Output for Class 16"
}

@app.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({"error": "No image uploaded"}), 400

    file = request.files['image']
    try:
        image = Image.open(file.stream).convert('RGB')
    except Exception as e:
        return jsonify({"error": "Invalid image file", "exception": str(e)}), 400

    # Let YOLOv5 handle resizing, letterboxing, and scaling
    results = model(image, size=480)

    predictions = []
    try:
        # YOLOv5 returns a tensor with columns: [x1, y1, x2, y2, confidence, class]
        detections = results.xyxyn[0]
        for detection in detections:
            cls_index = int(detection[5])
            confidence_score = float(detection[4])
            custom = custom_labels.get(cls_index, "Unknown Custom Output")
            original = model.names[cls_index] if cls_index in model.names else "Unknown"
            predictions.append({
                "custom": custom,
                "original": original,
                "confidence": confidence_score  # raw confidence (assumed to be between 0 and 1)
            })
    except Exception as e:
        return jsonify({"error": "Failed to extract predictions", "exception": str(e)}), 500

    if not predictions:
        predictions = [{"custom": "sorry no detections", "original": "", "confidence": 0.0}]

    return jsonify({"predictions": predictions})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
