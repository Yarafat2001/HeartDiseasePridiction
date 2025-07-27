import sys
import pickle
import pandas as pd

# Load the saved model
model_file = 'C:/xampp/htdocs/New folder (4)/heart_disease_model.pkl'
with open(model_file, 'rb') as f:
    model = pickle.load(f)

# Prepare input data from command line arguments
input_data = {
    'age': float(sys.argv[1]),
    'sex': int(sys.argv[2]),
    'cp': int(sys.argv[3]),
    'trestbps': float(sys.argv[4]),
    'chol': float(sys.argv[5]),
    'fbs': int(sys.argv[6]),
    'restecg': int(sys.argv[7]),
    'thalach': float(sys.argv[8]),
    'exang': int(sys.argv[9]),
    'oldpeak': float(sys.argv[10]),
    'slope': int(sys.argv[11]),
    'ca': int(sys.argv[12]),
    'thal': int(sys.argv[13])
}

# Convert input data into a DataFrame
input_df = pd.DataFrame([input_data])

# Make a prediction
prediction = model.predict(input_df)

# Output the result
if prediction[0] == 0:
    print("No Heart Disease")
else:
    print("Heart Disease")
