import pandas as pd
import numpy as np
import pickle
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression

# Load dataset
data = pd.read_csv('C:/xampp/htdocs/New folder (4)/heart.csv')

# Prepare data
X = data.drop(columns='target', axis=1)
Y = data['target']
X_train, X_test, Y_train, Y_test = train_test_split(X, Y, test_size=0.2, stratify=Y, random_state=2)

# Train model
model = LogisticRegression(max_iter=1000)
model.fit(X_train, Y_train)

# Save the model to a file
model_file = 'C:/xampp/htdocs/New folder (4)/heart_disease_model.pkl'
with open(model_file, 'wb') as f:
    pickle.dump(model, f)

print(f"Model saved to {model_file}")
